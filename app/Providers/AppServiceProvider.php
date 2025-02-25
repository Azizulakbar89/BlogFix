<?php

namespace App\Providers;

use App\Models\Artikel;
use App\Policies\BlogPolicy;
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
        //
    }
    protected $policies = [
        Artikel::class => BlogPolicy::class,
    ];
}