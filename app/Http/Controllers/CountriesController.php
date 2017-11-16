<?php

namespace SigeTurbo\Http\Controllers;

use Illuminate\Http\Response;

class CountriesController extends Controller
{

    /**
     * Display a listing of the resource.
     * GET /countries
     * @return Response
     */
    public function index()
    {
        return response()->json(Country::all());
    }


    /**
     * Display the specified resource.
     * GET /countries/{idcountry}
     * @param  int $idcountry
     * @return Response
     */
    public function show($idcountry)
    {
        return response()->json(Country::find($idcountry));
    }


}