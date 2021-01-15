<?php

namespace App\Providers;

use App\Services\Endpoint\Endpoint;
use App\Services\Endpoint\EndpointConverter;
use App\Services\Endpoint\EndpointGetter;
use App\Services\ModelSearch\RatingSearch;
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
        $this->app->bind(EndpointGetter::class,EndpointGetter::class);
        $this->app->bind(EndpointConverter::class,EndpointConverter::class);

        $this->app->bind(RatingSearch::class,RatingSearch::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(Endpoint::class,function ($app){
            return new Endpoint($app->make(EndpointConverter::class),
                                $app->make(EndpointGetter::class));

        });
    }
}
