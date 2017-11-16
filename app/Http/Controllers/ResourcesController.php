<?php

namespace SigeTurbo\Http\Controllers;

use SigeTurbo\Purchases\Purchases;

class ResourcesController extends Controller
{

    public function index()
    {
        return view('resources.index')->with('purchases', Purchases::getDiscounts()[0]);
    }
}