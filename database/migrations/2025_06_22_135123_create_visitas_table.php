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
        Schema::create('visitas', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('id_vendedor');
        $table->unsignedBigInteger('id_clientes');
        $table->dateTime('fecha_visita');
        $table->string('comentarios', 200)->nullable();
        $table->timestamps();

        $table->foreign('id_vendedor')->references('id')->on('vendedors');
        $table->foreign('id_clientes')->references('id')->on('clientes');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visitas');
    }
};
