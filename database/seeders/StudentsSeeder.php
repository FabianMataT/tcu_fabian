<?php

namespace Database\Seeders;

use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentsSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        DB::table('students')->insert([
            [
                'sub_grup_id' => 15,
                'id_card' => '1-2047-0605',
                'first_name' => 'MARIANGEL',
                'middle_name' => '',
                'last_name1' => 'ARTAVIA',
                'last_name2' => 'ALVARADO',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'sub_grup_id' => 15,
                'id_card' => '3-0583-0303',
                'first_name' => 'NAIDELYN',
                'middle_name' => 'PRISCILLA',
                'last_name1' => 'ANGULO',
                'last_name2' => 'TORRES',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'sub_grup_id' => 2,
                'id_card' => '3-0588-0392',
                'first_name' => 'DYLAN',
                'middle_name' => '',
                'last_name1' => 'ARAYA',
                'last_name2' => 'ROJAS',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'sub_grup_id' => 2,
                'id_card' => '3-0585-0236',
                'first_name' => 'JOSHUA',
                'middle_name' => 'ANDRES',
                'last_name1' => 'BRENES',
                'last_name2' => 'ARAYA',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'sub_grup_id' => 1,
                'id_card' => '1-2069-0421',
                'first_name' => 'JEINER',
                'middle_name' => 'SEBASTIAN',
                'last_name1' => 'CARMONA',
                'last_name2' => 'CABALLERO',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'sub_grup_id' => 1,
                'id_card' => '3-0586-0043',
                'first_name' => 'GENESIS',
                'middle_name' => 'MARIA',
                'last_name1' => 'CORTES',
                'last_name2' => 'ROMERO',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
