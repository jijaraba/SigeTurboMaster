<?php

namespace SigeTurbo\Http\Controllers;

use Illuminate\Http\Response;

class TaskfilesController extends Controller
{

    /**
     * Display a listing of the resource.
     * GET /taskfiles
     * @return Response
     */
    public function index()
    {
        return response()->json(Taskfile::all());
    }

    /**
     * Display the specified resource.
     * GET /tasks/{idtaskfile}
     * @param  int $idtaskfile
     * @return Response
     */
    public function show($idtaskfile)
    {
        return response()->json(Taskfile::find($idtaskfile));
    }


}