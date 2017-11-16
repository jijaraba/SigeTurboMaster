<?php

namespace SigeTurbo\Http\Controllers;

use SigeTurbo\Consenttype;
use Illuminate\Http\Response;

class ConsenttypesController extends Controller
{

    /**
     * Display a listing of the resource.
     * GET /consents
     * @return Response
     */
    public function index()
    {
        return response()->json(Consenttype::all());
    }
}