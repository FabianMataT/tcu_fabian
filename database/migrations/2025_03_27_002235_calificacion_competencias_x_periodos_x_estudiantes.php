<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('calificacion_competencias_x_periodos_x_estudiantes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade')->name('fk_calicicacionPeriodo_estudiante');
            $table->double('calificacion', 3, 2);
            $table->string('periodo');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('calificacion_competencias_x_periodos_x_estudiantes');
    }
};
