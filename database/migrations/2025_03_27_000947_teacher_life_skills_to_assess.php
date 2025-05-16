<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('teacher_life_skills_to_assess', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('subjects_taught_by_teacher_id');
            $table->foreign('subjects_taught_by_teacher_id', 'fk_teacher_subject_taught_assess')->references('id')->on('subjects_taught_by_teachers')->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('teacher_life_skills_to_assess');
    }
};
