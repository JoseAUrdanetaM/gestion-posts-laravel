<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class PostSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('posts')->insert([
            'title' => '¿Qué es un blog y para qué sirve?',
            'info' => 'Seguramente habrás escuchado el término “blogueros” o que en algún blog se reveló información importante acerca de un asunto político o de otro aspecto de la vida social. Pero ¿qué es un blog y para qué sirve? En esta lección podrás despejar esas inquietudes.',
            'img' => 'https://aprendelibvrefiles.blob.core.windows.net/aprendelibvre-container/course/crear_un_blog_en_internet/image/blog-l1-p1_xl.png'
        ]);
        DB::table('posts')->insert([
            'title' => '¿Qué es un blog?',
            'info' => 'Un blog es una página web en la que se publican regularmente artículos cortos con contenido actualizado y novedoso sobre temas específicos o libres. Estos artículos se conocen en inglés como "post" o publicaciones en español.',
            'img' => 'https://aprendelibvrefiles.blob.core.windows.net/aprendelibvre-container/course/crear_un_blog_en_internet/image/blogdelola-l1-p1_xl.png'
        ]);
        DB::table('posts')->insert([
            'title' => 'Crear un blog profesional',
            'info' => 'Un sinfín de recursos de diseño y herramientas de SEO y marketing integradas para crear un blog único y expandir tu presencia online.',
            'img' => 'https://static.wixstatic.com/media/0784b1_5d7f7bf7a21b4802aa083d9b03c7853b~mv2.jpg/v1/fill/w_1903,h_808,al_c,q_85,usm_0.66_1.00_0.01,enc_auto/0784b1_5d7f7bf7a21b4802aa083d9b03c7853b~mv2.jpg'
        ]);
    }
}
