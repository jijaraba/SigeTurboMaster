<?php

namespace SigeTurbo\Http\Controllers;

use Illuminate\Http\Response;
use SigeTurbo\Indicatortype;


class IndicatortypesController extends Controller {

	/**
	 * Display a listing of the resource.
	 * GET /indicatortypes
	 * @return Response
	 */
	public function index()
	{
		return response()->json(Indicatortype::all());
	}

	/**
	 * Display the specified resource.
	 * GET /indicatortypes/{idindicatortype}
	 * @param  int  $idindicatortype
	 * @return Response
	 */
	public function show($idindicatortype)
	{
		return response()->json(Indicatortype::find($idindicatortype));
	}


}