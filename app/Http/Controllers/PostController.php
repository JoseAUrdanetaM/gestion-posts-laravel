<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // Obtener todos los posts
    public function index()
    {
        $posts = Post::all();
        return response()->json([
            'message' => 'Lista de posts obtenida exitosamente.',
            'data' => $posts
        ], 200);
    }

    // Crear un nuevo post
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'info' => 'required|string',
            'img' => 'required|url',
        ]);

        $post = Post::create($validated);

        return response()->json([
            'message' => 'Post creado exitosamente.',
            'data' => $post
        ], 201);
    }

    // Mostrar un post específico
    public function show(Post $post)
    {
        return response()->json([
            'message' => 'Detalles del post obtenidos exitosamente.',
            'data' => $post
        ], 200);
    }

    // Actualizar un post existente
    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'info' => 'required|string',
            'img' => 'required|url',
        ]);

        $post->update($validated);

        return response()->json([
            'message' => 'Post actualizado exitosamente.',
            'data' => $post
        ], 200);
    }

    // Eliminar un post
    public function destroy(Post $post)
    {
        $post->delete();

        return response()->json([
            'message' => 'Post eliminado correctamente.'
        ], 200);
    }
}
