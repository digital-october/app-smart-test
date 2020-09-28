<?php

namespace App\Providers;

use App\Source\RedisAdapter;
use Illuminate\Cache\RedisStore;
use Illuminate\Support\Facades\Redis;
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
            $storage = new RedisStore(Redis::getFacadeRoot(), 'food_facts_');
            $cache = new RedisAdapter($storage);

            return new OpenfoodfactsSource($cache);
        });
    }
}
