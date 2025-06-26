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
       Schema::create('vendedors', function (Blueprint $table) {
       $table->id();
       $table->string('nombre_vendedor', 50);
       $table->string('apellido_paterno', 50);
       $table->string('apellido_materno', 50);
       $table->date('fecha_nacimiento')->nullable();
       $table->integer('ci')->nullable();
       $table->unsignedBigInteger('id_area_ventas')->nullable();
       $table->unsignedBigInteger('id_empresa')->nullable();
       $table->timestamps();

       $table->foreign('id_area_ventas')->references('id')->on('area_ventas');
       $table->foreign('id_empresa')->references('id')->on('empresas');
        });

    } 

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendedors');
    }
};
