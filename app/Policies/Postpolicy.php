<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class Postpolicy
{
   use HandlesAuthorization;

  public function update(User $user, Post $post)
  {
    return $user->id === $post->user_id || $user->role === 'admin';
  }

  public function approve(User $user)
  {
    return $user->role === 'admin';
  }


    public function __construct()
    {
        //
    }
}
