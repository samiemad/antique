<?php

namespace App\Providers;

use App\Category;
use App\Location;
use App\Role;
use App\User;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::share('roles', Role::all());
        View::share('locations', Location::all());
        View::share('categories', Category::all());
        View::share('users', User::all());
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
