<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PostPolicy
{
    public function viewAny(User $user)
    {
        return true; // Todos pueden ver los posts
    }

    public function view(User $user, Post $post)
    {
        return true; // Todos pueden ver los posts
    }

    public function create(User $user)
    {
        return $user->hasRole('user') || $user->hasRole('admin');
    }

    public function update(User $user, Post $post)
    {
        return $user->id === $post->user_id || $user->hasRole('admin');
    }

    public function delete(User $user, Post $post)
    {
        return $user->id === $post->user_id || $user->hasRole('admin');
    }
}
