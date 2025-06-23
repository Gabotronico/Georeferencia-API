<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Empresa;
use Illuminate\Http\Request;

class EmpresaController extends Controller
{
    public function index()
    {
        return Empresa::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_empresa' => 'required|string|max:50',
            'nit' => 'required|integer'
        ]);

        return Empresa::create([
            'nombre_empresa' => $request->nombre_empresa,
            'nit' => $request->nit
        ]);
    }

    public function show($id)
    {
        return Empresa::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $empresa = Empresa::findOrFail($id);

        $request->validate([
            'nombre_empresa' => 'required|string|max:50',
            'nit' => 'required|integer'
        ]);

        $empresa->update($request->all());

        return $empresa;
    }

    public function destroy($id)
    {
        return Empresa::destroy($id);
    }
}

