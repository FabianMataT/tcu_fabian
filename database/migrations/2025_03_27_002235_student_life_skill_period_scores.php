<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_life_skill_period_scores', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('student_id');
            $table->foreign('student_id', 'fk_period_score_student')->references('id')->on('students')->onDelete('cascade');
            
            $table->unsignedBigInteger('level_id');
            $table->foreign('level_id', 'fk_period_score_level')->references('id')->on('levels')->onDelete('cascade');

            $table->integer('period'); 
            $table->double('score', 3, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_life_skill_period_scores');
    }
};

