<?php

namespace SigeTurbo\Http\Controllers;

use Illuminate\Http\Response;
use SigeTurbo\Assessment;

class AssessmentsController extends Controller
{

    /**
     * Display a listing of the resource.
     * GET /assessments
     * @return Response
     */
    public function index()
    {
        return response()->json(Assessment::all());
    }

    /**
     * Display the specified resource.
     * GET /assessments/{idassessment}
     * @param  int $idassessment
     * @return Response
     */
    public function show($idassessment)
    {
        return response()->json(Assessment::all($idassessment));
    }


}