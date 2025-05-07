<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentsSeeder extends Seeder
{
    public function run(): void
    {
        Student::create([
            'sub_grup_id' => 2,
            'id_card' => '30546094',
            'first_name' => 'Randall',
            'middle_name' => 'Fabian',
            'last_name1' => 'mata',
            'last_name2' => 'tencio',
        ]);

        Student::create([
            'sub_grup_id' => 1,
            'id_card' => '56464',
            'first_name' => 'Grabriel',
            'middle_name' => 'Luis',
            'last_name1' => 'mata',
            'last_name2' => 'tencio',
        ]);

        Student::create([
            'sub_grup_id' => 2,
            'id_card' => '100001',
            'first_name' => 'Juan',
            'last_name1' => 'Pérez',
            'last_name2' => 'Gómez',
        ]);
        
        Student::create([
            'sub_grup_id' => 2,
            'id_card' => '100002',
            'first_name' => 'María',
            'last_name1' => 'López',
            'last_name2' => 'Martínez',
        ]);
        
        Student::create([
            'sub_grup_id' => 2,
            'id_card' => '100003',
            'first_name' => 'Carlos',
            'last_name1' => 'Ramírez',
            'last_name2' => 'Fernández',
        ]);
        
        Student::create([
            'sub_grup_id' => 2,
            'id_card' => '100004',
            'first_name' => 'Ana',
            'last_name1' => 'Sánchez',
            'last_name2' => 'Jiménez',
        ]);
        
        Student::create([
            'sub_grup_id' => 2,
            'id_card' => '100005',
            'first_name' => 'Luis',
            'last_name1' => 'Torres',
            'last_name2' => 'Díaz',
        ]);
        
        Student::create([
            'sub_grup_id' => 2,
            'id_card' => '100006',
            'first_name' => 'Elena',
            'last_name1' => 'Castro',
            'last_name2' => 'Ruiz',
        ]);
        
        Student::create([
            'sub_grup_id' => 2,
            'id_card' => '100007',
            'first_name' => 'Pedro',
            'last_name1' => 'Ortega',
            'last_name2' => 'Navarro',
        ]);
        
        
        Student::create([
            'sub_grup_id' => 1,
            'id_card' => '200001',
            'first_name' => 'Miguel',
            'last_name1' => 'Cortés',
            'last_name2' => 'Peña',
        ]);
        
        Student::create([
            'sub_grup_id' => 1,
            'id_card' => '200002',
            'first_name' => 'Andrea',
            'last_name1' => 'Rosales',
            'last_name2' => 'Morales',
        ]);
        
        Student::create([
            'sub_grup_id' => 1,
            'id_card' => '200003',
            'first_name' => 'Fernando',
            'last_name1' => 'Núñez',
            'last_name2' => 'Ibáñez',
        ]);
        
        Student::create([
            'sub_grup_id' => 1,
            'id_card' => '200004',
            'first_name' => 'Beatriz',
            'last_name1' => 'Gallardo',
            'last_name2' => 'Paredes',
        ]);
        
        Student::create([
            'sub_grup_id' => 1,
            'id_card' => '200005',
            'first_name' => 'Sergio',
            'last_name1' => 'Villanueva',
            'last_name2' => 'Reyes',
        ]);
        
        Student::create([
            'sub_grup_id' => 1,
            'id_card' => '200006',
            'first_name' => 'Valeria',
            'last_name1' => 'Camacho',
            'last_name2' => 'Suárez',
        ]);
        
        
    }
}
