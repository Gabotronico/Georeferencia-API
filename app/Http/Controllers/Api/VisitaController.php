<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Visita;
use App\Models\Vendedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotificacionVisitaMailable;

class VisitaController extends Controller
{
    public function index()
    {
        return Visita::with(['vendedor', 'cliente'])->get();
    }

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

        // 🟢 Enviar correo al vendedor
        $vendedor = Vendedor::with('clientes')->find($request->id_vendedor);
        $clientes = $vendedor->clientes->take(10); // Máximo 10 clientes

        if ($vendedor && $vendedor->correo) {
            Mail::to($vendedor->correo)->send(new NotificacionVisitaMailable($vendedor, $clientes));
        }

        return $visita;
    }

    public function show($id)
    {
        return Visita::with(['vendedor', 'cliente'])->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $visita = Visita::findOrFail($id);

        $request->validate([
            'id_vendedor' => 'required|exists:vendedors,id',
            'id_clientes' => 'required|exists:clientes,id',
            'fecha_visita' => 'required|date',
            'comentarios' => 'nullable|string|max:200',
            'estado' => 'nullable|in:Visitado,No visitado,Pendiente',
        ]);

        $visita->update($request->all());

        return $visita;
    }

    public function destroy($id)
    {
        return Visita::destroy($id);
    }
}
