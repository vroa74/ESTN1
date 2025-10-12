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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            
            // RFC y CURP opcionales en el registro web
            $table->string('rfc', 14)->nullable(); // RFC opcional, validado entre 10 a 14 caracteres
            $table->string('curp', 19)->nullable(); // CURP opcional, validado entre 10 a 19 caracteres
            $table->enum('sexo', ['femenino', 'masculino'])->nullable(); // Sexo: femenino o masculino
            $table->enum('theme', ['dark', 'light'])->default('light'); // Tema del usuario: dark o light
            
            // Campos administrativos (no aparecen en registro ni perfil)
            $table->tinyInteger('nivel')->default(7); // Nivel de acceso del usuario (1-7)
            $table->string('puesto', 70)->nullable(); // Puesto o cargo del usuarionb
            $table->boolean('estatus')->default(true); // Estado activo/inactivo del usuario

            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
