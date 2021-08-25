<?php

namespace App\Providers;

use App\Models\User;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Gate;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Pagination\Paginator as PaginationPaginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Gate::define('update-question', function ($user, $question) {
            return $user->id === $question->user_id;
        });

        Gate::define('delete-question', function ($user, $question) {
            return $user->id === $question->user_id;
        });
        Gate::define('is-admin', function (User $user) {
            return $user->role_id == Config::get('app.admin_id');
        });
        PaginationPaginator::useBootstrap();
    }
}
