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
        Schema::create('bitacoras', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null'); // Usuario que realiza la acción
            $table->foreignId('student_id')->nullable()->constrained('students')->onDelete('cascade'); // Estudiante relacionado (opcional)
            $table->string('accion', 100); // Tipo de acción realizada
            $table->string('modulo', 50)->nullable(); // Módulo del sistema donde se realiza la acción
            $table->text('descripcion')->nullable(); // Descripción detallada de la acción
            $table->string('ip', 45)->nullable(); // Dirección IP del usuario
            $table->string('user_agent', 255)->nullable(); // Navegador/dispositivo del usuario
            $table->time('hora'); // Hora de la acción (formato 24 horas)
            $table->date('fecha'); // Fecha de la acción
            $table->json('datos_anteriores')->nullable(); // Datos antes del cambio (JSON)
            $table->json('datos_nuevos')->nullable(); // Datos después del cambio (JSON)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bitacoras');
    }
};
