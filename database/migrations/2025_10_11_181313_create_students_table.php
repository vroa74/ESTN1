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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('matricula', 20)->unique()->nullable(); // Matrícula del estudiante
            $table->unsignedTinyInteger('grado')->nullable();
            $table->enum('grupo', ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L']); // Grupo del estudiante (A-L)
            $table->string('Fnom')->nullable();
            $table->string('nombres')->nullable();
            $table->string('apa')->nullable();
            $table->string('ama')->nullable();
            $table->date('fnac')->nullable();
            $table->string('curp', 18)->unique()->nullable(); // CURP del estudiante
            $table->enum('sexo', ['F', 'M'])->default('F'); // Sexo
            $table->boolean('sex')->default(1); // 1 = masculino (por convención)
            $table->string('email', 100)->unique()->nullable(); // Email del estudiante
            $table->string('telefono', 15)->nullable(); // Teléfono
            $table->enum('estatus', ['activo', 'inactivo', 'egresado', 'baja'])->default('activo'); // Estatus del estudiante
            $table->text('observaciones')->nullable(); // Observaciones adicionales
            $table->boolean('status')->default(1); // 1 = activo, 0 = inactivo
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
