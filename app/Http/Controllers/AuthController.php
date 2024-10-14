<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    // Método para registrar un nuevo usuario
    public function register(Request $request)
    {
        // Validar los datos de entrada del registro
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',

        ]);

        // Si la validación falla, retornar los errores
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        try {
            // Crear el usuario en la base de datos
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

            // Asignar automáticamente el rol 'user' al nuevo usuario
            $user->assignRole('user');

            // Crear el token de acceso
            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json(['data' => $user, 'access_token' => $token, 'token_type' => 'Bearer'], 201);
        } catch (\Exception $e) {
            // Manejo de excepciones en caso de error
            return response()->json(['error' => 'Error al registrar el usuario. Inténtalo nuevamente.'], 500);
        }
    }
    // Método para iniciar sesión
    public function login(Request $request)
    {
        // Intentar autenticar al usuario
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['error' => 'Credenciales no válidas.'], 401);
        }

        $user = User::where('email', $request['email'])->first();

        // Crear el token de acceso
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Bienvenido',
            'accessToken' => $token, // Retorna el token de acceso
            'token_type' => 'Bearer',
            'name' => $user->name, // Nombre del usuario
            'user_id' => $user->id,
            'role' => $user->getRoleNames(),  // Obtener los roles del usuario

        ], 200);
    }

    // Método para cerrar sesión
    public function logout()
    {
        auth()->user()->tokens()->delete();  // Eliminar todos los tokens del usuario
        return response()->json(['message' => 'Has cerrado sesión exitosamente.'], 200);
    }
}
