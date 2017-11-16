<?php namespace SigeTurbo\Facades;

use Illuminate\Support\Facades\Facade;

class Points extends Facade {

    protected static function getFacadeAccessor()
    {
        return "points";
    }

}