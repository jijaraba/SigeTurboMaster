<?php

namespace SigeTurbo\Http\Controllers;

use Illuminate\Http\Response;
use SigeTurbo\Indicatorcategory;


class IndicatorcategoriesController extends Controller {

	/**
	 * Display a listing of the resource.
	 * GET /indicatorcategories
	 * @return Response
	 */
	public function index()
	{
		return response()->json(Indicatorcategory::all());
	}

	/**
	 * Display the specified resource.
	 * GET /indicatorcategories/{idindicatorcategory}
	 * @param  int  $idindicatorcategory
	 * @return Response
	 */
	public function show($idindicatorcategory)
	{
		return response()->json(Indicatorcategory::find($idindicatorcategory));
	}


}