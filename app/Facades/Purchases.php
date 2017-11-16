<?php namespace Sige\Facades;

use Illuminate\Support\Facades\Facade;

class Purchases extends Facade {

    protected static function getFacadeAccessor()
    {
        return "purchases";
    }

}