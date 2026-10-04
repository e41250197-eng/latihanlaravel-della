<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // ACARA 24: Mendefinisikan Gate Sederhana
        Gate::define('edit-post', function (User $user, $post) {
            return $user->id === (int) $post->user_id;
        });
    }
}
