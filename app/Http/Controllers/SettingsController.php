<?php

namespace SigeTurbo\Http\Controllers;

use SigeTurbo\Facades\Points;

class SettingsController extends Controller
{

    /**
     * Display a listing of the resource.
     * GET /settings
     * @return Response
     */
    public function index()
    {
        return view('settings.index');
    }

    /**
     * @return mixed
     */
    public function points()
    {
        return view('settings.points');
    }

    /**
     * @return mixed
     */
    public function getpoints()
    {
        return response()->json(Points::getPoints());
    }

}