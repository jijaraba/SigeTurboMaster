<?php

namespace SigeTurbo\Http\Controllers;

use Illuminate\Http\Response;
use SigeTurbo\Monitoringcategory;

class MonitoringcategoriesController extends Controller
{

    /**
     * Display a listing of the resource.
     * GET /monitoringcategories
     * @return Response
     */
    public function index()
    {
        return response()->json(Monitoringcategory::all());
    }

    /**
     * Display the specified resource.
     * GET /monitoringcategories/{idmonitoringcategory}
     * @param  int $idmonitoringcategory
     * @return Response
     */
    public function show($idmonitoringcategory)
    {
        return response()->json(Monitoringcategory::find($idmonitoringcategory));
    }


}