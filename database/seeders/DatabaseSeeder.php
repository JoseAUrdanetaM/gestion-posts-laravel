<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Post;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {

        // Crea 10 usuarios
        User::factory(10)->create();

        // Crea 50 posts asociados a usuarios
        Post::factory(50)->create();

        $this->call([
            UserSeeder::class,
            RoleSeeder::class,
            PostSeeder::class,
        ]);
    }
}
