<?php

namespace App\Providers;

use App\Challenge;
use App\Policies\ChallengePolicy;
use App\Policies\PromotionRequestPolicy;
use App\Policies\UserPolicy;
use App\PromotionRequest;
use App\User;
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
        User::class => UserPolicy::class,
        Challenge::class => ChallengePolicy::class,
        PromotionRequest::class => PromotionRequestPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}
