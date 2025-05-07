<?php

namespace Database\Seeders;

use App\Models\Level;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LevelsSeeder extends Seeder
{
    public function run(): void
    {
        Level::create([
            'level' => 10,
            'name' => 'Décimo',
        ]);

        Level::create([
            'level' => 11,
            'name' => 'Undécimo',
        ]);

        Level::create([
            'level' => 12,
            'name' => 'Duodécimo',
        ]);
        
        Level::create([
            'level' => 12,
            'name' => 'Exestudiantes',
        ]);
    }
}
