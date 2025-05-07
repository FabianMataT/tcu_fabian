<?php

namespace Database\Seeders;

use App\Models\Module;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ModulesSeeder extends Seeder
{
    public function run(): void
    {
        Module::create([
            'name' => 'Opciones del Menú',
        ]);

        Module::create([
            'name' => 'Especialidades',
        ]);

        Module::create([
            'name' => 'Grupos',
        ]);

        Module::create([
            'name' => 'Estudiantes',
        ]);

        Module::create([
            'name' => 'Materias',
        ]);

        Module::create([
            'name' => 'Puestos',
        ]);

        Module::create([
            'name' => 'Roles y Permisos',
        ]);

        Module::create([
            'name' => 'Profesores',
        ]);

        Module::create([
            'name' => 'Competencias de Desarrollo Humano',
        ]);

        Module::create([
            'name' => 'Calificar Compentencias de los Estudiantes',
        ]);
    }
}
