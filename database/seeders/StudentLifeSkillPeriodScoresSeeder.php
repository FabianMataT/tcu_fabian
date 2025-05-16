<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentLifeSkillPeriodScoresSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();
        
        DB::table('student_life_skill_period_scores')->insert([
            [
                'student_id' => 2,
                'level_id' => 1,
                'period' => 1,
                'score' => 70.0,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'student_id' => 2,
                'level_id' => 1,
                'period' => 2,
                'score' => 95.0,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'student_id' => 2,
                'level_id' => 2,
                'period' => 1,
                'score' => 87.0,
                'created_at' => $now,
                'updated_at' => $now
            ],
        ]);
    }
}
