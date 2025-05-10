<?php

namespace Database\Seeders;

use App\Models\User;
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
            LevelsSeeder::class,
            PositionsSeeder::class,
            TeachersSeeder::class,
            GrupsSeeder::class,
            SubGrupsSeeder::class,
            SubjectsSeeder::class,
            SubjectsTaughtByTeachersSeeder::class,
            StudentsSeeder::class,
            LifeSkillsSeeder::class,
        ]);
    }
}
