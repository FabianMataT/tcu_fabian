<?php

namespace Database\Seeders;

use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentLifeSkillSubjectPeriodScoreDetailsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('student_life_skill_subject_period_score_details')->insert([
            ['student_life_skill_subject_period_score_id' => 1, 'name' => 'Autocontrol', 'earned_points' => 1],
            ['student_life_skill_subject_period_score_id' => 1, 'name' => 'Autoaprendizaje', 'earned_points' => 2],
            ['student_life_skill_subject_period_score_id' => 1, 'name' => 'Comunicación oral y escrita', 'earned_points' => 3],
            ['student_life_skill_subject_period_score_id' => 1, 'name' => 'Comunicación asertiva', 'earned_points' => 3],
            ['student_life_skill_subject_period_score_id' => 1, 'name' => 'Capacidad de negociación', 'earned_points' => 2],
            ['student_life_skill_subject_period_score_id' => 1, 'name' => 'Compromiso ético', 'earned_points' => 4],
            ['student_life_skill_subject_period_score_id' => 1, 'name' => 'Discernimiento y responsabilidad', 'earned_points' => 3],
            ['student_life_skill_subject_period_score_id' => 1, 'name' => 'Innovación y creatividad', 'earned_points' => 3],
            ['student_life_skill_subject_period_score_id' => 1, 'name' => 'Juicio y toma de decisiones', 'earned_points' => 3],
            ['student_life_skill_subject_period_score_id' => 1, 'name' => 'Liderazgo', 'earned_points' => 2],
            ['student_life_skill_subject_period_score_id' => 1, 'name' => 'Solución de problemas', 'earned_points' => 3],
            ['student_life_skill_subject_period_score_id' => 1, 'name' => 'Orientación y servicio al cliente', 'earned_points' => 4],
            ['student_life_skill_subject_period_score_id' => 1, 'name' => 'Proactividad', 'earned_points' => 4],
            ['student_life_skill_subject_period_score_id' => 1, 'name' => 'Pensamiento crítico', 'earned_points' => 3],
            ['student_life_skill_subject_period_score_id' => 1, 'name' => 'Trabajo en equipo', 'earned_points' => 3],
            ['student_life_skill_subject_period_score_id' => 1, 'name' => 'Respeto', 'earned_points' => 3],
            ['student_life_skill_subject_period_score_id' => 1, 'name' => 'Colaboración', 'earned_points' => 2],
            ['student_life_skill_subject_period_score_id' => 1, 'name' => 'Acatamiento de recomendaciones', 'earned_points' => 2],
            ['student_life_skill_subject_period_score_id' => 1, 'name' => 'Uso de tecnología', 'earned_points' => 3],
            ['student_life_skill_subject_period_score_id' => 1, 'name' => 'Cumplimiento de instrucciones con eficacia y eficiencia', 'earned_points' => 3],

            ['student_life_skill_subject_period_score_id' => 2, 'name' => 'Autocontrol', 'earned_points' => 4],
            ['student_life_skill_subject_period_score_id' => 2, 'name' => 'Autoaprendizaje', 'earned_points' => 4],
            ['student_life_skill_subject_period_score_id' => 2, 'name' => 'Comunicación oral y escrita', 'earned_points' => 4],
            ['student_life_skill_subject_period_score_id' => 2, 'name' => 'Comunicación asertiva', 'earned_points' => 4],
            ['student_life_skill_subject_period_score_id' => 2, 'name' => 'Capacidad de negociación', 'earned_points' => 4],
            ['student_life_skill_subject_period_score_id' => 2, 'name' => 'Compromiso ético', 'earned_points' => 3],
            ['student_life_skill_subject_period_score_id' => 2, 'name' => 'Discernimiento y responsabilidad', 'earned_points' => 3],
            ['student_life_skill_subject_period_score_id' => 2, 'name' => 'Innovación y creatividad', 'earned_points' => 3],
            ['student_life_skill_subject_period_score_id' => 2, 'name' => 'Juicio y toma de decisiones', 'earned_points' => 4],
            ['student_life_skill_subject_period_score_id' => 2, 'name' => 'Liderazgo', 'earned_points' => 4],
            ['student_life_skill_subject_period_score_id' => 2, 'name' => 'Solución de problemas', 'earned_points' => 4],
            ['student_life_skill_subject_period_score_id' => 2, 'name' => 'Orientación y servicio al cliente', 'earned_points' => 4],
            ['student_life_skill_subject_period_score_id' => 2, 'name' => 'Proactividad', 'earned_points' => 4],
            ['student_life_skill_subject_period_score_id' => 2, 'name' => 'Pensamiento crítico', 'earned_points' => 4],
            ['student_life_skill_subject_period_score_id' => 2, 'name' => 'Trabajo en equipo', 'earned_points' => 4],
            ['student_life_skill_subject_period_score_id' => 2, 'name' => 'Respeto', 'earned_points' => 4],
            ['student_life_skill_subject_period_score_id' => 2, 'name' => 'Colaboración', 'earned_points' => 3],
            ['student_life_skill_subject_period_score_id' => 2, 'name' => 'Acatamiento de recomendaciones', 'earned_points' => 4],
            ['student_life_skill_subject_period_score_id' => 2, 'name' => 'Uso de tecnología', 'earned_points' => 4],
            ['student_life_skill_subject_period_score_id' => 2, 'name' => 'Cumplimiento de instrucciones con eficacia y eficiencia', 'earned_points' => 4],
        ]);
    }
}
