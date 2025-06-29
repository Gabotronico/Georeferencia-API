<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index(Request $request)
    {
        $query = Cliente::with(['vendedor', 'zona', 'departamento', 'tipoCliente']);

        // Filtro opcional por nombre del cliente
        if ($request->filled('nombre')) {
            $query->where('nombre_cliente', 'like', '%' . $request->nombre . '%');
        }

        // Filtro opcional por ID del vendedor
        if ($request->filled('id_vendedor')) {
            $query->where('id_vendedor', $request->id_vendedor);
        }

        return $query->get();
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
            'correo' => 'nullable|email|max:150',
            'latitud' => 'required|numeric',
            'longitud' => 'required|numeric'
        ]);

        $cantidadClientes = Cliente::where('id_vendedor', $request->id_vendedor)->count();
        if ($cantidadClientes >= 10) {
            return response()->json(['error' => 'El vendedor ya tiene el máximo de 10 clientes registrados.'], 400);
        }

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
            'correo' => 'nullable|email|max:150',
            'latitud' => 'required|numeric',
            'longitud' => 'required|numeric'
            
        ]);

        $cliente->update($request->all());

        return $cliente;
    }

    public function destroy($id)
    {
        return Cliente::destroy($id);
    }
}
