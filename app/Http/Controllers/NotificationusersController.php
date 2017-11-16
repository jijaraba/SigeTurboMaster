<?php

namespace SigeTurbo\Http\Controllers;

use SigeTurbo\Facades\Alert;

class NotificationusersController extends Controller {

	/**
	 * Display a listing of the resource.
	 * GET /notificationusers
	 * @return Response
	 */
	public function index()
	{
        return Alert::count(1);
        //return Response::json(Notificationuser::all());
	}


	/**
	 * Display the specified resource.
	 * GET /notificationusers/{idnotificationuser}
	 * @param  int  $idnotificationuser
	 * @return Response
	 */
	public function show($idnotificationuser)
	{
        return response()->json(Notificationuser::find($idnotificationuser));
	}


}