<?php

namespace App\Providers;

use App\Helpers\Roles;
use Carbon\CarbonInterval;
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;
use Illuminate\Support\Facades\Gate;

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
        Passport::personalAccessTokensExpireIn(now()->addDays(15));
        Passport::tokensExpireIn(now()->addDays(30));
        Passport::refreshTokensExpireIn(now()->addDays(60));
        Passport::tokensCan([
            Roles::ROLE_ADMIN => 'admin',
            Roles::ROLE_SUPER_ADMIN => 'super_admin',
            Roles::ROLE_USER => 'user',
        ]);
        Passport::setDefaultScope([Roles::ROLE_SUPER_ADMIN]);

        // Customize Gate authorization denial message to Uzbek
        Gate::after(function ($user, $ability, $result) {
            if ($result === false) {
                throw new \Illuminate\Auth\Access\AuthorizationException(
                    __('messages.unauthorized')
                );
            }
        });
    }
}
