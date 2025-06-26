<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index()
    {
        return Cliente::with(['vendedor', 'zona', 'departamento', 'tipoCliente'])->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_cliente' => 'required|string|max:100',
            'id_vendedor' => 'required|exists:vendedors,id',
            'id_zona' => 'required|exists:zonas,id',
            'id_departamento' => 'required|exists:departamentos,id',
            'id_tipo_cliente' => 'required|exists:tipo_clientes,id',
            'barrio' => 'nullable|string|max:100',
            'latitud' => 'required|numeric',
            'longitud' => 'required|numeric',
        ]);

        return Cliente::create($request->all());
    }

    public function show($id)
    {
        return Cliente::with(['vendedor', 'zona', 'departamento', 'tipoCliente'])->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $cliente = Cliente::findOrFail($id);

        $request->validate([
            'nombre_cliente' => 'required|string|max:100',
            'id_vendedor' => 'required|exists:vendedors,id',
            'id_zona' => 'required|exists:zonas,id',
            'id_departamento' => 'required|exists:departamentos,id',
            'id_tipo_cliente' => 'required|exists:tipo_clientes,id',
            'barrio' => 'nullable|string|max:100',
            'latitud' => 'required|numeric',
            'longitud' => 'required|numeric',
        ]);

        $cliente->update($request->all());

        return $cliente;
    }

    public function destroy($id)
    {
        return Cliente::destroy($id);
    }
    // Buscar cliente por nombre (coincidencia parcial o todos si no hay nombre)
    public function buscarPorNombre(Request $request)
    {
        $nombre = $request->query('nombre');

        $query = Cliente::with(['vendedor', 'zona', 'departamento', 'tipoCliente']);
        if ($nombre) {
            $query->where('nombre_cliente', 'like', "%{$nombre}%");
        }
        $clientes = $query->get();

        return response()->json($clientes);
    }
}

