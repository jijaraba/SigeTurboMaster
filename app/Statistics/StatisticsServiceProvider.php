<?php namespace SigeTurbo\Statistics;

use Illuminate\Support\ServiceProvider;

class StatisticsServiceProvider extends ServiceProvider {

    public function register()
    {
        App::bind('statistics','Sige\Statistics\Statistics');
    }

}