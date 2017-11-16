<?php namespace SigeTurbo\Purchases;

use Illuminate\Support\ServiceProvider;

class PurchasesServiceProvider extends ServiceProvider {

    public function register()
    {
        $this->app->bind('purchases','SigeTurbo\Purchases\Purchases');
    }

}