<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Verificar si el usuario ya existe antes de crearlo
        if (!User::where('email', 'test@example.com')->exists()) {
            User::create([
                'name' => 'Test User',
                'email' => 'test@example.com',
                'password' => Hash::make('password123'), // Se recomienda usar una contraseña segura
            ]);
        }

        // Ejecutar el seeder general de las demás tablas
        $this->call(BaseDatosSeeder::class);
    }
}
