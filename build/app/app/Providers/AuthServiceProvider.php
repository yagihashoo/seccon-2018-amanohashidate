<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Register roles
        Gate::define('user', function ($user) {
            return ($user->role == 0);
        });

        Gate::define('setter', function ($user) {
            return ($user->role == 1);
        });

        Gate::define('admin', function ($user) {
            return ($user->role == 2);
        });
    }
}
