<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Rutas públicas (cualquiera puede ver los posts)
Route::get('posts', [PostController::class, 'index']);
Route::get('posts/{post}', [PostController::class, 'show']);
Route::get('/users/{id}/posts', [PostController::class, 'getPostsByUser']);


// Rutas protegidas (solo usuarios autenticados)
Route::middleware(['auth:sanctum'])->group(function () {

    // Solo los usuarios autenticados pueden crear, actualizar o eliminar sus posts
    Route::post('posts', [PostController::class, 'store']);      // Crear
    Route::put('posts/{post}', [PostController::class, 'update']); // Modificar
    Route::delete('posts/{post}', [PostController::class, 'destroy']); // Eliminar


    // Rutas protegidas (solo admin)
    Route::get('/admin/users', [AdminController::class, 'index']);
    Route::post('/admin/users', [AdminController::class, 'store']);
    Route::get('/admin/users/{user}', [AdminController::class, 'show']);
    Route::put('/admin/users/{user}', [AdminController::class, 'update']);
    Route::delete('/admin/users/{user}', [AdminController::class, 'destroy']);

    // Logout
    Route::get('logout', [AuthController::class, 'logout']);
});


// Rutas de autenticación
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
