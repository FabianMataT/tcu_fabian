<?php

namespace Database\Seeders;

use App\Models\Teacher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeachersSeeder extends Seeder
{
    public function run(): void
    {
        Teacher::create([
            'first_name' => 'Gabriel',
            'middle_name' => 'Luis',
            'last_name1' => 'Nuñez',
            'last_name2' => 'Gonzalez',
            'email' => 'gabriel@gmail.com',
            'phone' => "75478953",
            'user_id' => 2,
            'position_id' => 2,
        ]);

        Teacher::create([
            'first_name' => 'Ruben',
            'middle_name' => '',
            'last_name1' => 'Ortega',
            'last_name2' => 'Salas',
            'email' => 'ruben@gmail.com',
            'phone' => "984034022",
            'user_id' => 3,
            'position_id' => 2,
        ]);

        Teacher::create([
            'first_name' => 'María',
            'middle_name' => 'Elena',
            'last_name1' => 'Vargas',
            'last_name2' => 'Solano',
            'email' => 'maria.vargas@gmail.com',
            'phone' => '85236974',
            'user_id' => 4,
            'position_id' => 2,
        ]);
        
        Teacher::create([
            'first_name' => 'José',
            'middle_name' => 'Andrés',
            'last_name1' => 'Camacho',
            'last_name2' => 'Pérez',
            'email' => 'jose.camacho@gmail.com',
            'phone' => '86741235',
            'user_id' => 5,
            'position_id' => 2,
        ]);
        
    }
}
