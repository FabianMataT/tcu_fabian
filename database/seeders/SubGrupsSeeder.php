<?php

namespace Database\Seeders;

use App\Models\SubGrup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubGrupsSeeder extends Seeder
{
    public function run(): void
    {
        SubGrup::create([
            'grup_id' => 1,
            'specialtie_id' => 4,
            'name' => 'A'
        ]);

        SubGrup::create([
            'grup_id' => 1,
            'specialtie_id' => 1,
            'name' => 'B'
        ]);
        
        SubGrup::create([
            'grup_id' => 2,
            'specialtie_id' => 1,
            'name' => 'A'
        ]);

        SubGrup::create([
            'grup_id' => 2,
            'specialtie_id' => 5,
            'name' => 'B'
        ]);

        SubGrup::create([
            'grup_id' => 3,
            'specialtie_id' => 2,
            'name' => 'A'
        ]);

        SubGrup::create([
            'grup_id' => 3,
            'specialtie_id' => 5,
            'name' => 'B'
        ]);
        
        SubGrup::create([
            'grup_id' => 4,
            'specialtie_id' => 2,
            'name' => 'A'
        ]);

        SubGrup::create([
            'grup_id' => 4,
            'specialtie_id' => 9,
            'name' => 'B'
        ]);

        SubGrup::create([
            'grup_id' => 5,
            'specialtie_id' => 8,
            'name' => 'A'
        ]);

        SubGrup::create([
            'grup_id' => 5,
            'specialtie_id' => 4,
            'name' => 'B'
        ]);
        
        SubGrup::create([
            'grup_id' => 6,
            'specialtie_id' => 6,
            'name' => 'A'
        ]);

        SubGrup::create([
            'grup_id' => 6,
            'specialtie_id' => 2,
            'name' => 'B'
        ]);
        
        SubGrup::create([
            'grup_id' => 7,
            'specialtie_id' => 2,
            'name' => 'A'
        ]);

        SubGrup::create([
            'grup_id' => 7,
            'specialtie_id' => 5,
            'name' => 'B'
        ]);
        
        SubGrup::create([
            'grup_id' => 8,
            'specialtie_id' => 4,
            'name' => 'A'
        ]);

        SubGrup::create([
            'grup_id' => 8,
            'specialtie_id' => 9,
            'name' => 'B'
        ]);
        
        SubGrup::create([
            'grup_id' => 9,
            'specialtie_id' => 4,
            'name' => 'A'
        ]);

        SubGrup::create([
            'grup_id' => 9,
            'specialtie_id' => 1,
            'name' => 'B'
        ]);
        
        SubGrup::create([
            'grup_id' => 10,
            'specialtie_id' => 3,
            'name' => 'A'
        ]);

        SubGrup::create([
            'grup_id' => 11,
            'specialtie_id' => 2,
            'name' => 'A'
        ]);

        SubGrup::create([
            'grup_id' => 11,
            'specialtie_id' => 5,
            'name' => 'B'
        ]);
        
        SubGrup::create([
            'grup_id' => 12,
            'specialtie_id' => 2,
            'name' => 'A'
        ]);

        SubGrup::create([
            'grup_id' => 12,
            'specialtie_id' => 6,
            'name' => 'B'
        ]);
        
        SubGrup::create([
            'grup_id' => 13,
            'specialtie_id' => 4,
            'name' => 'A'
        ]);

        SubGrup::create([
            'grup_id' => 13,
            'specialtie_id' => 1,
            'name' => 'B'
        ]);
        
        SubGrup::create([
            'grup_id' => 14,
            'specialtie_id' => 4,
            'name' => 'A'
        ]);

        SubGrup::create([
            'grup_id' => 14,
            'specialtie_id' => 7,
            'name' => 'B'
        ]);
    }
}
