<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AreaVenta;
use Illuminate\Http\Request;

class AreaVentaController extends Controller
{
    public function index()
    {
        return AreaVenta::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_area' => 'required|string|max:100',
        ]);

        return AreaVenta::create([
            'nombre_area' => $request->nombre_area
        ]);
    }

    public function show($id)
    {
        return AreaVenta::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $area = AreaVenta::findOrFail($id);

        $request->validate([
            'nombre_area' => 'required|string|max:100',
        ]);

        $area->update($request->all());

        return $area;
    }

    public function destroy($id)
    {
        return AreaVenta::destroy($id);
    }
}
