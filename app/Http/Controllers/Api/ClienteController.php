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

        if ($request->has('id_vendedor')) {
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
            'latitud' => 'required|numeric',
            'longitud' => 'required|numeric',
        ]);

        // Verificar límite de clientes por vendedor
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

    // Buscar por nombre (coincidencia parcial)
    public function buscarPorNombre(Request $request)
    {
        $nombre = $request->query('nombre');
        $idVendedor = $request->query('id_vendedor');

        $query = Cliente::with(['vendedor', 'zona', 'departamento', 'tipoCliente']);

        if ($nombre) {
            $query->where('nombre_cliente', 'like', "%{$nombre}%");
        }

        if ($idVendedor) {
            $query->where('id_vendedor', $idVendedor);
        }

        return $query->get();
    }
    // Buscar clientes por ID de vendedor
public function buscarPorVendedor(Request $request)
    {
    $vendedorId = $request->query('id_vendedor');

    $clientes = Cliente::with(['vendedor', 'zona', 'departamento', 'tipoCliente'])
        ->when($vendedorId, function ($query) use ($vendedorId) {
            return $query->where('id_vendedor', $vendedorId);
        })
        ->get();

    return response()->json($clientes);
    }
    
}

