<?php

namespace Database\Seeders;

use App\Models\Position;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PositionsSeeder extends Seeder
{
    public function run(): void
    {
        Position::create([
            'name' => 'Profesor Académico',
        ]);

        Position::create([
            'name' => 'Profesor Técnico',
        ]);
        
        Position::create([
            'name' => 'Orientador',
        ]);
        
        Position::create([
            'name' => 'Coordinador con la empresa',
        ]);

        Position::create([
            'name' => 'Director',
        ]);
    }
}
