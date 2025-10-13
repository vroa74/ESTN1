<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Agregar índices FULLTEXT para búsquedas en campos de texto
        DB::statement('ALTER TABLE reportes_alumnos ADD FULLTEXT(descripcion_reporte)');
        DB::statement('ALTER TABLE reportes_alumnos ADD FULLTEXT(observaciones)');
        DB::statement('ALTER TABLE reportes_alumnos ADD FULLTEXT(descripcion_reporte, observaciones)');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Eliminar los índices FULLTEXT
        DB::statement('ALTER TABLE reportes_alumnos DROP INDEX descripcion_reporte');
        DB::statement('ALTER TABLE reportes_alumnos DROP INDEX observaciones');
        DB::statement('ALTER TABLE reportes_alumnos DROP INDEX descripcion_reporte_observaciones');
    }
};