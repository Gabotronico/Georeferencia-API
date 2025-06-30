<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Visita;
use App\Models\Vendedor;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotificacionVisitaMailable;
use App\Mail\NotificacionClienteMailable;

class VisitaController extends Controller
{
    // ✅ Listado con filtros
    public function index(Request $request)
    {
        $query = Visita::with(['vendedor', 'cliente']);

        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }

        if ($request->filled('id_vendedor')) {
            $query->where('id_vendedor', $request->id_vendedor);
        }

        return $query->orderBy('created_at', 'desc')->get();
    }

    // ✅ Registro de visita + notificación a vendedor y cliente
    public function store(Request $request)
    {
        $request->validate([
            'id_vendedor' => 'required|exists:vendedors,id',
            'id_clientes' => 'required|exists:clientes,id',
            'fecha_visita' => 'required|date',
            'comentarios' => 'nullable|string|max:200',
            'estado' => 'nullable|in:Visitado,No visitado,Pendiente',
        ]);

        $visita = Visita::create($request->all());

        // 🔹 Notificar al vendedor
        $vendedor = Vendedor::with('clientes')->find($request->id_vendedor);
        $clientes = $vendedor->clientes->take(10);

        if ($vendedor && $vendedor->correo) {
            Mail::to($vendedor->correo)->send(new NotificacionVisitaMailable($vendedor, $clientes));
        }

        // 🔹 Notificar al cliente
        $cliente = Cliente::find($request->id_clientes);
        if ($cliente && $cliente->correo) {
            Mail::to($cliente->correo)->send(new NotificacionClienteMailable($cliente, $visita));
        }

        return $visita;
    }

    public function show($id)
    {
        return Visita::with(['vendedor', 'cliente'])->findOrFail($id);
    }

    // ✅ Reprogramación si estaba "No visitado" + notificación
    public function update(Request $request, $id)
    {
        $visita = Visita::findOrFail($id);

        $request->validate([
            'id_vendedor' => 'required|exists:vendedors,id',
            'id_clientes' => 'required|exists:clientes,id',
            'fecha_visita' => 'date', // ya no es requerido
            'comentarios' => 'nullable|string|max:200',
            'estado' => 'nullable|in:Visitado,No visitado,Pendiente',
        ]);

        // Si la fecha cambia, crear un nuevo registro con la nueva fecha y sin comentario
        if ($request->filled('fecha_visita') && $request->fecha_visita !== $visita->fecha_visita) {
            $nuevaVisita = Visita::create([
                'id_vendedor'   => $visita->id_vendedor,
                'id_clientes'   => $visita->id_clientes,
                'fecha_visita'  => $request->fecha_visita,
                'comentarios'   => null,
                'estado'        => 'Pendiente',
            ]);

            // Notificar cliente
            $cliente = Cliente::find($visita->id_clientes);
            if ($cliente && $cliente->correo) {
                Mail::to($cliente->correo)->send(new NotificacionClienteMailable($cliente, $nuevaVisita));
            }

            // Notificar vendedor
            $vendedor = Vendedor::with('clientes')->find($visita->id_vendedor);
            $clientes = $vendedor ? $vendedor->clientes->take(10) : collect();

            if ($vendedor && $vendedor->correo) {
                Mail::to($vendedor->correo)->send(new NotificacionVisitaMailable($vendedor, $clientes));
            }
        }

        // Si el estado es Visitado y hay fecha_visita en el request, NO actualizar la fecha en el registro actual
        $data = $request->all();
        if (($visita->estado === 'Visitado' || $request->estado === 'Visitado') && $request->filled('fecha_visita')) {
            unset($data['fecha_visita']);
        }
        $visita->update($data);
        return $visita;
    }

    public function destroy($id)
    {
        return Visita::destroy($id);
    }
}

