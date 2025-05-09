<?php

namespace Database\Seeders;

use App\Models\Grup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GrupsSeeder extends Seeder
{
    public function run(): void
    {
        Grup::create([
            'level_id' => 1,
            'name' => '1'
        ]);

        Grup::create([
            'level_id' => 1,
            'name' => '2'
        ]);

        Grup::create([
            'level_id' => 1,
            'name' => '3'
        ]);

        Grup::create([
            'level_id' => 1,
            'name' => '4'
        ]);

        Grup::create([
            'level_id' => 1,
            'name' => '5'
        ]);

        Grup::create([
            'level_id' => 2,
            'name' => '1'
        ]);

        Grup::create([
            'level_id' => 2,
            'name' => '2'
        ]);

        Grup::create([
            'level_id' => 2,
            'name' => '3'
        ]);

        Grup::create([
            'level_id' => 2,
            'name' => '4'
        ]);
        
        Grup::create([
            'level_id' => 2,
            'name' => '5'
        ]);

        Grup::create([
            'level_id' => 3,
            'name' => '1'
        ]);
        
        Grup::create([
            'level_id' => 3,
            'name' => '2'
        ]);

        Grup::create([
            'level_id' => 3,
            'name' => '3'
        ]);
        
        Grup::create([
            'level_id' => 3,
            'name' => '4'
        ]);
        
        Grup::create([
            'level_id' => 3,
            'name' => '5'
        ]);
    }
}
