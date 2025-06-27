<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\User;

use App\Http\Controllers\Api\{
    ClienteController,
    VendedorController,
    VisitaController,
    ZonaController,
    DepartamentoController,
    TipoClienteController,
    AreaVentaController,
    EmpresaController
};

// Ruta de prueba
Route::get('/prueba', function () {
    return response()->json(['mensaje' => 'API funcionando correctamente']);
});

// Registro
Route::post('/register', function (Request $request) {
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:6',
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    return response()->json(['message' => 'Usuario registrado'], 201);
});

// Login
Route::post('/login', function (Request $request) {
    $user = User::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages([
            'email' => ['Credenciales incorrectas.'],
        ]);
    }

    return response()->json([
        'token' => $user->createToken('token-api')->plainTextToken,
        'user' => $user,
    ]);
});


Route::apiResource('clientes', ClienteController::class);
Route::apiResource('vendedores', VendedorController::class);
Route::apiResource('visitas', VisitaController::class);
Route::apiResource('zonas', ZonaController::class);
Route::apiResource('departamentos', DepartamentoController::class);
Route::apiResource('tipo-clientes', TipoClienteController::class);
Route::apiResource('area-ventas', AreaVentaController::class);
Route::apiResource('empresas', EmpresaController::class);

// 📌 Rutas protegidas por token Sanctum
Route::middleware('auth:sanctum')->group(function () {

});
