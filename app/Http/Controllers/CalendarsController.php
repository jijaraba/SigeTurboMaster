<?php

namespace SigeTurbo\Http\Controllers;
use SigeTurbo\Calendar;
use Illuminate\Http\Response;

class CalendarsController extends Controller
{

    /**
     * Display a listing of the resource.
     * GET /calendars
     * @return Response
     */
    public function index()
    {
        return response()->json(Calendar::all());
    }

    /**
     * Display the specified resource.
     * GET /calendars/{idcalendar}
     * @param int $idcalendar
     * @return Response
     */
    public function show($idcalendar)
    {
        return response()->json(Calendar::find($idcalendar));
    }
}