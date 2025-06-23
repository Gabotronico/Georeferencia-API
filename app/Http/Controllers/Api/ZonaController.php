<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Zona;

class ZonaController extends Controller
{
    public function index()
    {
        return response()->json(Zona::all(), 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_zona' => 'required|string|max:50',
        ]);

        $zona = Zona::create($request->all());
        return response()->json($zona, 201);
    }

    public function show($id)
    {
        $zona = Zona::find($id);

        if (!$zona) {
            return response()->json(['mensaje' => 'Zona no encontrada'], 404);
        }

        return response()->json($zona, 200);
    }

    public function update(Request $request, $id)
    {
        $zona = Zona::find($id);

        if (!$zona) {
            return response()->json(['mensaje' => 'Zona no encontrada'], 404);
        }

        $request->validate([
            'nombre_zona' => 'required|string|max:50',
        ]);

        $zona->update($request->all());
        return response()->json($zona, 200);
    }

    public function destroy($id)
    {
        $zona = Zona::find($id);

        if (!$zona) {
            return response()->json(['mensaje' => 'Zona no encontrada'], 404);
        }

        $zona->delete();
        return response()->json(['mensaje' => 'Zona eliminada correctamente'], 200);
    }
}
