<?php

namespace Database\Seeders;

use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentLifeSkillSubjectPeriodScoresSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        DB::table('student_life_skill_subject_period_scores')->insert([
            [
                'student_life_skill_period_score_id' => 1,
                'subject_id' => 10,
                'teacher_id' => 1,
                'score' => 70.0,
                'total_points' => 80,
                'earned_points' => 56,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'student_life_skill_period_score_id' => 2,
                'subject_id' => 9,
                'teacher_id' => 1,
                'score' => 95.0,
                'total_points' => 80,
                'earned_points' => 76,
                'created_at' => $now,
                'updated_at' => $now
            ],
        ]);
    }
}
