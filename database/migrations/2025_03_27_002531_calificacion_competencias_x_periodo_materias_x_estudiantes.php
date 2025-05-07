<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('calificacion_competencias_x_periodo_materias_x_estudiantes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('calificacion_competencias_x_periodos_x_estudianteID')->constrained('calificacion_competencias_x_periodos_x_estudiantes')->onDelete('cascade')->name('fk_calicicacionMateria_calificacionPerido');
            $table->foreignId('materia_impartidad_x_profesorID')->constrained('materias_impartidas_x_profesores')->onDelete('cascade')->name('fk_calicicacionMateria_materiasProfesores');;
            $table->double('calificacion', 3, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('calificacion_competencias_x_periodo_materias_x_estudiantes');
    }
};
