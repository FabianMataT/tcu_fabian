<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_life_skill_subject_period_scores', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('student_life_skill_period_score_id');
            $table->foreign('student_life_skill_period_score_id', 'fk_subject_period_score_to_life_skill_period_score')->references('id')->on('student_life_skill_period_scores')->onDelete('cascade');

            $table->unsignedBigInteger('subject_id');
            $table->foreign('subject_id', 'fk_subject_period_score_subject')->references('id')->on('subjects')->onDelete('cascade');

            $table->unsignedBigInteger('teacher_id');
            $table->foreign('teacher_id', 'fk_subject_period_score_teacher')->references('id')->on('teachers')->onDelete('cascade');

            $table->double('score', 3, 2);
            $table->integer('total_points');
            $table->integer('earned_points');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_life_skill_subject_period_scores');
    }
};
