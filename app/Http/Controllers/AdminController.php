<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // Obtener todos los usuarios
    public function index()
    {
        $users = User::all();
        return response()->json([
            'message' => 'Lista de usuarios obtenida exitosamente.',
            'data' => $users
        ], 200);
    }

    // Crear un nuevo usuario
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|string|in:user,admin' // Validar el rol
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        // Asignar el rol
        $user->assignRole($request->role);

        return response()->json([
            'message' => 'Usuario creado exitosamente.',
            'data' => $user
        ], 201);
    }

    // Mostrar un usuario específico
    public function show(User $user)
    {
        return response()->json([
            'message' => 'Detalles del usuario obtenidos exitosamente.',
            'data' => $user
        ], 200);
    }

    // Actualizar un usuario existente
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8',
            'role' => 'required|string|in:user,admin' // Validar el rol
        ]);

        // Actualizar los campos
        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        // Asignar el nuevo rol
        $user->syncRoles([$request->role]);

        return response()->json([
            'message' => 'Usuario actualizado exitosamente.',
            'data' => $user
        ], 200);
    }

    // Eliminar un usuario
    public function destroy(User $user)
    {
        // No permitir que el administrador se elimine a sí mismo
        if ($user->id === Auth::id()) {
            return response()->json([
                'message' => 'No puedes eliminarte a ti mismo.'
            ], 403);
        }

        $user->delete();
        return response()->json([
            'message' => 'Usuario eliminado exitosamente.'
        ], 200);
    }
}
