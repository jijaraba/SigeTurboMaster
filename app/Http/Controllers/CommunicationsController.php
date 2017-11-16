<?php

namespace SigeTurbo\Http\Controllers;

class CommunicationsController extends Controller
{

    /**
     * Display a listing of the resource.
     * GET /partials
     * @return Response
     */
    public function index()
    {
        return view('communications.index');
    }


}