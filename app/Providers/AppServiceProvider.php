<?php

namespace App\Providers;

use App\MyService\StoreImage;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->singleton('StoreImage', function ($app) {
            return new StoreImage();
        });
    }
}
