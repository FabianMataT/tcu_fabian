<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{

    public function run(): void
    {
        User::create([
            'name' => 'Hernan Hidalgo Corrales',
            'email' => 'hernan@gmail.com',
            'password' => bcrypt('12345678')
        ])->assignRole('Administrador');
        /*
        User::create([
            'name' => 'Gabriel',
            'email' => 'gabriel@gmail.com',
            'password' => bcrypt('12345678')
        ])->assignRole('Profesor nvl 1');
        
        User::create([
            'name' => 'Ruben',
            'email' => 'ruben@gmail.com',
            'password' => bcrypt('12345678')
        ])->assignRole('Profesor nvl 1');

        User::create([
            'name' => 'María',
            'email' => 'maria.vargas@gmail.com',
            'password' => bcrypt('12345678')
        ])->assignRole('Profesor nvl 2');
        
        User::create([
            'name' => 'José',
            'email' => 'jose@gmail.com',
            'password' => bcrypt('12345678')
        ])->assignRole('Profesor nvl 2');
    
        */
    }
}
