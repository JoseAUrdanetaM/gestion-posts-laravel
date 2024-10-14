<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    protected $model = User::class; // Define el modelo que esta fábrica va a utilizar

    /**
     * Definición de los atributos del modelo User.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(), // Genera un nombre aleatorio para el usuario
            'email' => $this->faker->unique()->safeEmail(), // Genera un correo electrónico único y seguro
            'password' => bcrypt('password'), // Encripta la contraseña por defecto
            'role' => 'user', // Rol por defecto del usuario, se puede cambiar según sea necesario
        ];
    }
}
