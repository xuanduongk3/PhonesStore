<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Category;
// use Illuminate\Contracts\View\View;

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
        view()->share('categories', Category::all());
    }
}
