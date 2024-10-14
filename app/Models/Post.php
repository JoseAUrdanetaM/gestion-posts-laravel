<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;  // Habilita las fábricas para este modelo

    protected $table = 'posts'; // Define el nombre de la tabla en la base de datos

    // Campos que se pueden asignar de manera masiva
    protected $fillable = [
        'title',  // Título del post
        'info',   // Información o contenido del post
        'img',    // URL de la imagen asociada al post
        'user_id', // ID del usuario que creó el post
    ];

    // Relación con el usuario
    public function user()
    {
        return $this->belongsTo(User::class); // Define que cada post pertenece a un usuario
    }
}
