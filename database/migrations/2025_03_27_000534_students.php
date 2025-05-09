<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sub_grup_id')->constrained('sub_grups')->onDelete('cascade');
            $table->string('id_card')->unique();
            $table->string('first_name');
            $table->string('middle_name')->default('');
            $table->string('last_name1');
            $table->string('last_name2');;
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
