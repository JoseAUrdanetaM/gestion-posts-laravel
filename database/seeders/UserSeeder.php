<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{

    public function run(): void
    {
        // Crear un usuario
        User::create([
            'name' => 'Admin',
            'email' => 'admin@ejemplo.com',
            'password' => Hash::make('password123'), // Encripta la contraseña
        ]);

        User::create([
            'name' => 'user',
            'email' => 'usern@ejemplo.com',
            'password' => Hash::make('password123'), // Encripta la contraseña
        ]);
    }
}
