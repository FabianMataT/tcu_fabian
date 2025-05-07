<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('detalle_calificacion_competencias_x_materias_x_estudiantes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('calificacion_competencias_x_periodo_materias_x_estudiantesID')->constrained('calificacion_competencias_x_periodo_materias_x_estudiantes')->onDelete('cascade')->name('fk_detalle_calificacion_calicicacionMateria');
            $table->string('nombreCompetenciaDesarrolloHumano');
            $table->integer('calificacion');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detalle_calificacion_competencias_x_materias_x_estudiantes');
    }
};
