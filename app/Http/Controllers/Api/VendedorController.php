<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Vendedor;
use Illuminate\Http\Request;

class VendedorController extends Controller
{
    public function index()
    {
        return Vendedor::with(['areaVentas', 'empresa'])->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_vendedor' => 'required|string|max:50',
            'apellido_paterno' => 'required|string|max:50',
            'apellido_materno' => 'required|string|max:50',
        ]);

        return Vendedor::create($request->all());
    }

    public function show($id)
    {
        return Vendedor::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $vendedor = Vendedor::findOrFail($id);

        $request->validate([
            'nombre_vendedor' => 'required|string|max:50',
            'apellido_paterno' => 'required|string|max:50',
            'apellido_materno' => 'required|string|max:50',
            'fecha_nacimiento' => 'required|date',
            'id_area_ventas' => 'required|exists:area_ventas,id',
            'id_empresa' => 'required|exists:empresas,id',
        ]);

        $vendedor->update($request->all());

        return $vendedor;
    }

    public function destroy($id)
    {
        return Vendedor::destroy($id);
    }
}

