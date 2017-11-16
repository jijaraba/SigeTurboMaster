<?php

namespace SigeTurbo\Http\Controllers;

use Illuminate\Http\Response;
use SigeTurbo\Bloodtype;

class BloodtypesController extends Controller
{

    /**
     * Display a listing of the resource.
     * GET /bloodtypes
     * @return Response
     */
    public function index()
    {
        return response()->json(Bloodtype::all());
    }

    /**
     * Display the specified resource.
     * GET /bloodtypes/{idbloodtype}
     * @param int $idbloodtype
     * @return Response
     */
    public function show($idbloodtype)
    {
        return response()->json(Bloodtype::find($idbloodtype));
    }


}