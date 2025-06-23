<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_cliente', 100); 
            $table->unsignedBigInteger('id_vendedor');
            $table->unsignedBigInteger('id_zona');
            $table->unsignedBigInteger('id_departamento');
            $table->unsignedBigInteger('id_tipo_cliente');
            $table->string('barrio', 100)->nullable();
            $table->float('latitud');
            $table->float('longitud');
            $table->timestamps();

            $table->foreign('id_vendedor')->references('id')->on('vendedors');
            $table->foreign('id_zona')->references('id')->on('zonas');
            $table->foreign('id_departamento')->references('id')->on('departamentos');
            $table->foreign('id_tipo_cliente')->references('id')->on('tipo_clientes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
