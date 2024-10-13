<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


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

    // Mostrar un post específico
    public function show(Post $post)
    {
        return response()->json([
            'message' => 'Detalles del post obtenidos exitosamente.',
            'data' => $post
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

        try {
            $post = Post::create([
                'title' => $request->title,
                'info' => $request->info,
                'img' => $request->img,
                'user_id' => Auth::id(),
            ]);

            return response()->json([
                'message' => 'Post creado exitosamente.',
                'data' => $post
            ], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al crear el post. Inténtalo nuevamente.'], 500);
        }
    }

    // Actualizar un post existente
    public function update(Request $request, Post $post)
    {

        $this->authorize('update', $post);

        $request->validate([
            'title' => 'required|string|max:255',
            'info' => 'required|string',
            'img' => 'required|url',
        ]);

        try {
            $post->update($request->all());

            return response()->json([
                'message' => 'Post actualizado exitosamente.',
                'data' => $post
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al actualizar el post.'], 500);
        }
    }

    // Eliminar un post
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();
        return response()->json(['message' => 'Post eliminado correctamente.'], 200);
    }
}
