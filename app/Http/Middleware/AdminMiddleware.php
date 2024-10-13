<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::user() || !Auth::user()->hasRole('admin')) {
            return response()->json(['message' => 'Acceso denegado.'], 403);
        }

        return $next($request);
    }
}
