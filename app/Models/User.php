<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles; // Habilita características de autenticación, notificaciones y roles

    /**
     * Los atributos que son asignables de manera masiva.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',     // Nombre del usuario
        'email',    // Correo electrónico del usuario
        'password', // Contraseña del usuario
    ];

    /**
     * Los atributos que deben estar ocultos para la serialización.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',      // Ocultar la contraseña al serializar
        'remember_token', // Token de recordar sesión, si se utiliza
    ];

    /**
     * Los atributos que deben ser convertidos.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime', // Convierte el campo en un objeto de fecha
    ];
}
