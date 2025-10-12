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
        Schema::create('reportes_alumnos', function (Blueprint $table) {
            $table->id();
            
            // Datos del estudiante
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            
            // Información del reporte
            $table->date('fecha_reporte'); // Fecha del reporte
            $table->string('materia', 100); // Materia del reporte
            
            
            // Descripción del reporte
            $table->text('descripcion_reporte'); // Descripción del reporte (puede ser larga)
            
            // Estados del reporte
            $table->enum('estado', ['pendiente', 'firmado_prefecto', 'firmado_trabajo_social', 'completado'])->default('pendiente');
            
            
            // Observaciones adicionales
            $table->text('observaciones')->nullable(); // Observaciones adicionales
            
            // Control de versiones
            $table->integer('version')->default(1); // Versión del reporte (para modificaciones)
            
            // Usuarios involucrados (relaciones con tabla users)
            $table->foreignId('profesor_id')->constrained('users')->onDelete('cascade'); // Profesor que hace el reporte
            $table->foreignId('prefecto_id')->nullable()->constrained('users')->onDelete('set null'); // Prefecto que firma
            $table->foreignId('trabajo_social_id')->nullable()->constrained('users')->onDelete('set null'); // Trabajador social que firma
            $table->timestamps();
            
            // Índices para mejorar rendimiento
            $table->index(['student_id', 'fecha_reporte']);
            $table->index(['profesor_id', 'fecha_reporte']);
            $table->index('estado');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reportes_alumnos');
    }
};
