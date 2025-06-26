<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Visita;
use Illuminate\Http\Request;

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

        return Visita::create($request->all());
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
