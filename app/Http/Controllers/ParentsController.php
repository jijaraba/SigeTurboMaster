<?php

namespace SigeTurbo\Http\Controllers;

class ParentsController extends Controller
{

    /**
     * Display a listing of the resource.
     * GET /parents
     * @return Response
     */
    public function index()
    {
        return view('parents.index');
    }

}