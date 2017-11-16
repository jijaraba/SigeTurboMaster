<?php

namespace SigeTurbo\Http\Controllers;

class FormationController extends Controller
{

    /**
     * Formation Dashboard
     */
    public function index()
    {
        return view('formation.index');
    }

}