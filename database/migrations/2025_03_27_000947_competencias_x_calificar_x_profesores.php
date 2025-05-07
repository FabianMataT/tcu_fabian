<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('competencias_x_calificar_x_profesores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('materia_impartida_x_profesorID')->constrained('materias_impartidas_x_profesores')->onDelete('cascade')->name('fk_competencia_materia');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('competencias_x_calificar_x_profesores');
    }
};
