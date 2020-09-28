<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Source\Openfoodfacts\OpenfoodfactsSource;

class OpenfoodfactsProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton(OpenfoodfactsSource::class, function ($app) {
            $cacheClass = config('cache.cache_instance');
            $cacheInstance = new $cacheClass();

            return new OpenfoodfactsSource($cacheInstance);
        });
    }
}
