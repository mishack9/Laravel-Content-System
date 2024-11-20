<?php

namespace App\Providers;

use App\Models\Post;
use App\Models\User;
use App\Policies\Postpolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{


   /*  protected $policies = [
        Post::class => Postpolicy::class,
    ];
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Gate::define('update', function(User $user){
            return $user->role === 'editor';
        });

        Gate::define('approve', function(User $user){
            return $user->role === 'admin';
        });

        Gate::define('reject', function(User $user){
           return $user->role === 'admin';
        });
    }
}
