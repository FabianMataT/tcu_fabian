<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('students_to_assess_life_skills', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('teacher_life_skills_to_assess_id');
            $table->foreign('teacher_life_skills_to_assess_id', 'fk_students_assessments_by_teacher')->references('id')->on('teacher_life_skills_to_assess')->onDelete('cascade');

            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('students_to_assess_life_skills');
    }
};
