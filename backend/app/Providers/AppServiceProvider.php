<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Dingo\Api\Transformer\Adapter\Fractal;
use League\Fractal\Manager;
use League\Fractal\Serializer\JsonApiSerializer;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app['Dingo\Api\Transformer\Factory']->setAdapter(function ($app) {
           $fractal = new Manager();
           $fractal->setSerializer(new JsonApiSerializer());

           return new Fractal($fractal);
        });
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
