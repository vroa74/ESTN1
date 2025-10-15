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
            
            // Información del estudiante
            $table->unsignedBigInteger('student_id');
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            
            // Información del reporte
            $table->date('fecha_reporte');
            $table->string('materia', 100);
            $table->text('descripcion_reporte');
            $table->text('observaciones')->nullable();
            $table->enum('estado', ['pendiente', 'no firmado', 'atendido'])->default('pendiente');
            $table->integer('version')->default(1);
            
            // Usuarios involucrados (TODOS OBLIGATORIOS - NOT NULL)
            $table->unsignedBigInteger('profesor_id'); // Docente que hace el reporte
            $table->foreign('profesor_id')->references('id')->on('users')->onDelete('cascade');
            
            $table->unsignedBigInteger('prefecto_id'); // Prefecto que firma
            $table->foreign('prefecto_id')->references('id')->on('users')->onDelete('cascade');
            
            $table->unsignedBigInteger('trabajo_social_id'); // Trabajador social que firma
            $table->foreign('trabajo_social_id')->references('id')->on('users')->onDelete('cascade');
            
            // Campos de firma
            $table->timestamp('firma_prefecto_at')->nullable();
            $table->timestamp('firma_trabajo_social_at')->nullable();
            
            $table->timestamps();
            
            // Índices para mejorar rendimiento
            $table->index(['student_id', 'fecha_reporte']);
            $table->index(['profesor_id', 'fecha_reporte']);
            $table->index(['prefecto_id', 'fecha_reporte']);
            $table->index(['trabajo_social_id', 'fecha_reporte']);
            $table->index('estado');
            $table->index('fecha_reporte');
            
            // Índices fulltext para búsquedas
            $table->fullText(['descripcion_reporte', 'observaciones']);
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