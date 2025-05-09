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
            $table->foreignId('subjects_taugh_by_teacher_id')->constrained('subjects_taugh_by_teachers')->onDelete('cascade')->name('fk_teacher_subject_competency');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('competencias_x_calificar_x_profesores');
    }
};
