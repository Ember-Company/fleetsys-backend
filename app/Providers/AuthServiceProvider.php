<?php

namespace App\Providers;

use App\Models\Company;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
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
        Gate::define('is-company-member', function(User $user, Company $company) {
            return $user->company->id === $company->id;
        });

        Gate::define('admin-action', function (User $user, Company $company) {
            return Gate::allows('is-company-member', $company) && $user->isAdmin() || $user->isMaster();
        });
    }
}
