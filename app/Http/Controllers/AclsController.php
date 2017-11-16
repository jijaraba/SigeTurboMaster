<?php

namespace SigeTurbo\Http\Controllers;

use Illuminate\Http\Response;
use SigeTurbo\Acl;

class AclsController extends Controller
{

    /**
     * Display a listing of the resource.
     * GET /acls
     * @return Response
     */
    public function index()
    {
        return response()->json(Acl::all());
    }

    /**
     * Display the specified resource.
     * GET /acls/{idacl}
     * @param  int $idacl
     * @return Response
     */
    public function show($idacl)
    {
        return response()->json(Acl::find($idacl));
    }


}