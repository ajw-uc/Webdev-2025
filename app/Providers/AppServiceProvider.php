<?php

namespace App\Providers;

use App\Enums\UserRoleEnum;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

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
        Gate::define('isAdmin', function ($user) {
            return $user->role->value === UserRoleEnum::Administrator->value;
        });
        Gate::define('isAuthor', function ($user) {
            return $user->role->value === UserRoleEnum::Author->value;
        });

        Paginator::useBootstrapFive();
    }
}
