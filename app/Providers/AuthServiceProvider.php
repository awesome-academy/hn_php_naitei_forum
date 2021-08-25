<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('accept', function ($user, $answer) {
            return $user->id === $answer->question->user_id;
        });

        Gate::define('update-answer', function ($user, $answer) {
            return $user->id === $answer->user_id;
        });

        Gate::define('delete-answer', function ($user, $answer) {
            return $user->id === $answer->user_id;
        });
    }
}
