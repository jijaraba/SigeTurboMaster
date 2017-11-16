<?php

namespace SigeTurbo\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class PointsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        App::bind(
            'points',
            'SigeTurbo\Points\Points'
        );
    }
}
