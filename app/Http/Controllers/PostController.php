<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PostController extends Controller
{
    // Obtener todos los posts
    public function index()
    {
        $posts = Post::all(); // Recupera todos los posts de la base de datos
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
        // Validar la entrada del nuevo post
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'info' => 'required|string',
            'img' => 'required|url',
        ]);

        try {
            // Crear el nuevo post en la base de datos
            $post = Post::create([
                'title' => $request->title,
                'info' => $request->info,
                'img' => $request->img,
                'user_id' => Auth::id(), // Asociar el post con el usuario autenticado
            ]);

            return response()->json([
                'message' => 'Post creado exitosamente.',
                'data' => $post // Retorna el post creado en formato JSON
            ], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al crear el post. Inténtalo nuevamente.'], 500);
        }
    }

    // Actualizar un post existente
    public function update(Request $request, Post $post)
    {
        // Verificar que el usuario tenga permisos para actualizar el post
        $this->authorize('update', $post);

        // Validar la entrada del post actualizado
        $request->validate([
            'title' => 'required|string|max:255',
            'info' => 'required|string',
            'img' => 'required|url',
        ]);

        try {
            // Actualizar los campos del post
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
        // Verificar que el usuario tenga permisos para eliminar el post
        $this->authorize('delete', $post);
        $post->delete(); // Elimina el post de la base de datos
        return response()->json(['message' => 'Post eliminado correctamente.'], 200);
    }

    public function getPostsByUser($id)
    {
        // Verifica si el usuario existe
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        // Obtiene los posts que pertenecen al usuario
        $posts = Post::where('user_id', $id)->get();

        return response()->json($posts);
    }
}
