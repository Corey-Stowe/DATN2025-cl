<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Notifications\ResetPassword;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        ResetPassword::createUrlUsing(function ($notifiable, $token) {
            $user = User::where('email', '=',$notifiable->email)->first();
            if ($user->roles_id == 2) {
                return url('reset-password/' . $token . '?email=' . urlencode($notifiable->email));
            } else {
                return url('admin-reset-password/' . $token . '?email=' . urlencode($notifiable->email));
            }
        });
    }
}
