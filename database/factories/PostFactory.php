<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    protected $model = Post::class; // Define el modelo que esta fábrica va a utilizar

    /**
     * Definición de los atributos del modelo Post.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(), // Genera un título aleatorio
            'info' => $this->faker->text(200),    // Genera un texto aleatorio de 200 caracteres para la información
            'content' => $this->faker->paragraph(), // Genera un párrafo aleatorio para el contenido del post
            'img' => $this->faker->imageUrl(),     // Genera una URL de imagen aleatoria
            'user_id' => User::factory(),           // Crea y asocia cada post a un usuario utilizando la fábrica de usuarios
        ];
    }
}
