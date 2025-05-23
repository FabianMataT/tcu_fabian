<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            ModulesSeeder::class,
            RolesPermisosSeeder::class,
            UserSeeder::class,
            SpecialtiesSeeder::class,
            SubjectsSeeder::class,
            LevelsSeeder::class,
            PositionsSeeder::class,
            TeachersSeeder::class,
            GrupsSeeder::class,
            SubGrupsSeeder::class,
            SubjectsTaughtByTeachersSeeder::class,
            StudentsSeeder::class,
            LifeSkillsSeeder::class,
            StudentLifeSkillScoresSeeder::class,
            StudentLifeSkillPeriodScoresSeeder::class,
            StudentLifeSkillSubjectPeriodScoresSeeder::class,
            StudentLifeSkillSubjectPeriodScoreDetailsSeeder::class, 
        ]);
    }
}
