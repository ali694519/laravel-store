<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;



class CartServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
       $this->app->bind(\App\Repositories\Cart\CartRepository::class, function () {
             return new \App\Repositories\Cart\CartModelRepository();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
