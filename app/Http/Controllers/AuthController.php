<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    public function register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',

        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        try {
            // Crear el usuario
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

            // Asignar automáticamente el rol 'user'
            $user->assignRole('user');

            // Crear el token de acceso
            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json(['data' => $user, 'access_token' => $token, 'token_type' => 'Bearer'], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al registrar el usuario. Inténtalo nuevamente.'], 500);
        }
    }

    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['error' => 'Credenciales no válidas.'], 401);
        }

        $user = User::where('email', $request['email'])->first();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Bienvenido',
            'accessToken' => $token,
            'token_type' => 'Bearer',
            'name' => $user->name, // Nombre del usuario
            'role' => $user->getRoleNames(),

        ], 200);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
        return response()->json(['message' => 'Has cerrado sesión exitosamente.'], 200);
    }
}
