<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use App\Models\User;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first(); // Asume que ya tienes un usuario en la base de datos

        //
        DB::table('posts')->insert([
            'title' => '¿Qué es un blog y para qué sirve?',
            'info' => 'Seguramente habrás escuchado el término “blogueros” o que en algún blog se reveló información importante acerca de un asunto político o de otro aspecto de la vida social. Pero ¿qué es un blog y para qué sirve? En esta lección podrás despejar esas inquietudes.',
            'img' => 'https://picsum.photos/536/354',
            'user_id' => $user->id,
        ]);
        DB::table('posts')->insert([
            'title' => '¿Qué es un blog?',
            'info' => 'Un blog es una página web en la que se publican regularmente artículos cortos con contenido actualizado y novedoso sobre temas específicos o libres. Estos artículos se conocen en inglés como "post" o publicaciones en español.',
            'img' => 'https://picsum.photos/536/354',
            'user_id' => $user->id,

        ]);
        DB::table('posts')->insert([
            'title' => 'Crear un blog profesional',
            'info' => 'Un sinfín de recursos de diseño y herramientas de SEO y marketing integradas para crear un blog único y expandir tu presencia online.',
            'img' => 'https://picsum.photos/536/354',
            'user_id' => $user->id,
        ]);
    }
}
