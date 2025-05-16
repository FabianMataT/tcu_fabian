<?php

namespace Database\Seeders;

use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StudentLifeSkillScoresSeeder extends Seeder
{
    public function run(): void
    { 
        
        $now = Carbon::now();

        DB::table('student_life_skill_scores')->insert([
            [
                'student_id' => 1,
                'score' => 100.0,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'student_id' => 2,
                'score' => 81.25,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'student_id' => 3,
                'score' => 100.0,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'student_id' => 4,
                'score' => 100.0,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'student_id' => 5,
                'score' => 100.0,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'student_id' => 6,
                'score' => 100.0,
                'created_at' => $now,
                'updated_at' => $now
            ],
        ]);
    }
}
