<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_life_skill_subject_period_score_details', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('student_life_skill_subject_period_score_id');
            $table->foreign('student_life_skill_subject_period_score_id', 'fk_score_details_subject_period_score')
                ->references('id')->on('student_life_skill_subject_period_scores')
                ->onDelete('cascade');

            $table->string('name');
            $table->integer('earned_points');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_life_skill_subject_period_score_details');
    }
};
