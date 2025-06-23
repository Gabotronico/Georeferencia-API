<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Departamento;
use Illuminate\Http\Request;

class DepartamentoController extends Controller
{
    public function index()
    {
        return Departamento::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_departamento' => 'required|string|max:100',
        ]);

        return Departamento::create($request->all());
    }

    public function show($id)
    {
        return Departamento::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $departamento = Departamento::findOrFail($id);
        $departamento->update($request->all());
        return $departamento;
    }

    public function destroy($id)
    {
        return Departamento::destroy($id);
    }
}
