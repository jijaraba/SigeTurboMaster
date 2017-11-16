<?php

namespace SigeTurbo\Http\Controllers;

use Illuminate\Http\Response;
use SigeTurbo\Maritalstatus;

class MaritalstatusesController extends Controller {

	/**
	 * Display a listing of the resource.
	 * GET /maritalstatuses
	 * @return Response
	 */
	public function index()
	{
		return response()->json(Maritalstatus::all());
	}

	/**
	 * Display the specified resource.
	 * GET /maritalstatuses/{idmaritalstatus}
	 * @param  int  $idmaritalstatus
	 * @return Response
	 */
	public function show($idmaritalstatus)
	{
		return response()->json(Maritalstatus::find($idmaritalstatus));
	}


}