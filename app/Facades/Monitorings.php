<?php

namespace SigeTurbo\Facades;

use Illuminate\Support\Facades\Facade;

class Monitorings extends Facade
{

    protected static function getFacadeAccessor()
    {
        return "monitorings";
    }

}