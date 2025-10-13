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
        Schema::create('materias', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('grado')->nullable(); 
            $table->string('materia', 100); // Nombre de la materia
            $table->timestamps();

            // Índices para mejorar rendimiento
            $table->index('grado');
            $table->index('materia');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materias');
    }
};
