<?php

namespace App\Http\Controllers\api;

use App\Models\TipoCliente;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TipoClienteController extends Controller
{
    public function index()
    {
        return TipoCliente::all();
    }

    public function store(Request $request)
    {
        $request->validate([
        'nombre_tipo_cliente' => 'required|string|max:50',
    ]);

    return TipoCliente::create([
        'nombre_tipo_cliente' => $request->nombre_tipo_cliente
    ]);
    }

    public function show($id)
    {
        return TipoCliente::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $tipo = TipoCliente::findOrFail($id);
        $tipo->update($request->all());
        return $tipo;
    }

    public function destroy($id)
    {
        return TipoCliente::destroy($id);
    }
}
