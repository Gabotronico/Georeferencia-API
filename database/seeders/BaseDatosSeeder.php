<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class BaseDatosSeeder extends Seeder
{
    public function run(): void
    {
        // 🔹 Zonas
        DB::table('zonas')->insert([
            ['nombre_zona' => 'Este'],
            ['nombre_zona' => 'Oeste'],
            ['nombre_zona' => 'Norte'],
            ['nombre_zona' => 'Sur'],
        ]);

        // 🔹 Departamentos
        DB::table('departamentos')->insert([
            ['nombre_departamento' => 'Cochabamba'],
            ['nombre_departamento' => 'Tarija'],
            ['nombre_departamento' => 'Santa Cruz'],
            ['nombre_departamento' => 'La Paz'],
            ['nombre_departamento' => 'Oruro'],
            ['nombre_departamento' => 'Potosí'],
            ['nombre_departamento' => 'Chuquisaca'],
            ['nombre_departamento' => 'Beni'],
            ['nombre_departamento' => 'Pando'],
        ]);

        // 🔹 Tipo de Cliente
        DB::table('tipo_clientes')->insert([
            ['nombre_tipo_cliente' => 'Institucional'],
            ['nombre_tipo_cliente' => 'Distribuidor'],
        ]);

        // 🔹 Área de ventas
        DB::table('area_ventas')->insert([
            ['nombre_area' => 'Ventas Directas'],
            ['nombre_area' => 'Televentas'],
            ['nombre_area' => 'Ventas por Catálogo'],
            ['nombre_area' => 'Ventas Corporativas'],
        ]);

        // 🔹 Empresas
        DB::table('empresas')->insert([
            ['nombre_empresa' => 'Quimica Bolivia', 'nit' => 100200300],
            ['nombre_empresa' => 'Limpio Express', 'nit' => 200300400],
        ]);

        // 🔹 Vendedores
       // 🔹 Vendedores
         DB::table('vendedors')->insert([
            [
        'nombre_vendedor' => 'Gabriel',
        'apellido_paterno' => 'Cabrera',
        'apellido_materno' => 'Rojas',
        'fecha_nacimiento' => '1995-01-01',
        'correo' => 'cabrerarojasgabriel@gmail.com',
        'id_area_ventas' => 1,
        'id_empresa' => 1,
         ],
         [
        'nombre_vendedor' => 'Rodrigo',
        'apellido_paterno' => 'Mareño',
        'apellido_materno' => 'López',
        'fecha_nacimiento' => '1990-05-12',
        'correo' => 'rodrigo@luri.com',
        'id_area_ventas' => 2,
        'id_empresa' => 2,
         ],
]);


        // 🔹 Clientes
        DB::table('clientes')->insert([
            [
                'nombre_cliente' => 'Farmacia Central',
                'id_vendedor' => 1,
                'id_zona' => 1,
                'id_departamento' => 1,
                'id_tipo_cliente' => 1,
                'barrio' => 'Queru Queru',
                'correo' => 'farmaciacentral@gmail.com',
                'latitud' => -17.3934,
                 'longitud' => -66.1571,
            ],
            [
                'nombre_cliente' => 'Hospital San Juan',
                'id_vendedor' => 2,
                'id_zona' => 2,
                'id_departamento' => 2,
                'id_tipo_cliente' => 2,
                'barrio' => 'San Roque',
                'correo' => 'hospitalsanjuan@salud.bo',
                'latitud' => -21.5336,
                'longitud' => -64.7296,
            ],
        ]);

        // 🔹 Visitas (con estado agregado)
        DB::table('visitas')->insert([
            [
                'id_vendedor' => 1,
                'id_clientes' => 1,
                'fecha_visita' => Carbon::now()->subDays(2),
                'comentarios' => 'Cliente interesado en contrato mensual.',
                'estado' => 'Pendiente',
            ],
            [
                'id_vendedor' => 2,
                'id_clientes' => 2,
                'fecha_visita' => Carbon::now(),
                'comentarios' => 'Visita técnica para presentación de catálogo.',
                'estado' => 'Pendiente',
            ],
        ]);
    }
}

