<?php

namespace SigeTurbo\Http\Controllers;

use Illuminate\Http\Response;

class ProvenancesController extends Controller
{

    /**
     * Display a listing of the resource.
     * GET /provenances
     * @return Response
     */
    public function index()
    {
        return response()->json(Provenance::all());
    }

    /**
     * Display the specified resource.
     * GET /provenances/{idprovenance}
     * @param  int $idprovenance
     * @return Response
     */
    public function show($idprovenance)
    {
        return response()->json(Provenance::find($idprovenance));
    }

}