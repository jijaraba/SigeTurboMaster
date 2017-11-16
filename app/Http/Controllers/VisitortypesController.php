<?php

namespace SigeTurbo\Http\Controllers;

use Illuminate\Http\Response;

class VisitortypesController extends Controller {

	/**
	 * Display a listing of the resource.
	 * GET /visitortypes
	 * @return Response
	 */
	public function index()
	{
		return response()->json(Visitortype::all());
	}


	/**
	 * Display the specified resource.
	 * GET /visitortypes/{idvisitortype}
	 * @param  int  $idvisitortype
	 * @return Response
	 */
	public function show($idvisitortype)
	{
		return response()->json(Visitortype::find($idvisitortype));
	}


}