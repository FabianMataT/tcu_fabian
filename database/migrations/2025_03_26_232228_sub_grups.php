<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sub_grups', function (Blueprint $table) {
            $table->id();
            $table->foreignId('grup_id')->constrained('grups')->onDelete('cascade');
            $table->foreignId('specialtie_id')->constrained('specialties')->onDelete('cascade');
            $table->string('name');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sub_grups');
    }
};
