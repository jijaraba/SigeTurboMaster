<?php namespace Sige\Facades;

use Illuminate\Support\Facades\Facade;

class Statistics extends Facade {

    protected static function getFacadeAccessor()
    {
        return "statistics";
    }

}