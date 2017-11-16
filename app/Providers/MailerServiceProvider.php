<?php

namespace SigeTurbo\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class MailerServiceProvider extends ServiceProvider
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
            'SigeTurbo\Mailer\MailerInterface',
            'SigeTurbo\Mailer\Mailer'
        );
    }
}
