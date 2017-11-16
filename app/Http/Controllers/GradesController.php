<?php

namespace SigeTurbo\Http\Controllers;

use Illuminate\Http\Response;

class GradesController extends Controller {

	/**
	 * Display a listing of the resource.
	 * GET /grades
	 * @return Response
	 */
	public function index()
	{
		return response()->json(Grade::all());
	}

	/**
	 * Display the specified resource.
	 * GET /grades/{idgrade}
	 * @param  int  $idgrade
	 * @return Response
	 */
	public function show($idgrade)
	{
		return response()->json(Grade::find($idgrade));
	}

}