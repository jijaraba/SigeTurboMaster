<?php

namespace SigeTurbo\Http\Controllers;

use Illuminate\Http\Response;

class DepartmentsController extends Controller {

	/**
	 * Display a listing of the resource.
	 * GET /departments
	 * @return Response
	 */
	public function index()
	{
		return response()->json(Department::all());
	}

	/**
	 * Display the specified resource.
	 * GET /departments/{iddepartment}
	 * @param  int  $iddepartment
	 * @return Response
	 */
	public function show($iddepartment)
	{
		return response()->json(Department::find($iddepartment));
	}


}