<?php

namespace SigeTurbo\Http\Controllers;

use Illuminate\Http\Response;


class ProductcategoriesController extends Controller
{

    /**
     * Display a listing of the resource.
     * GET /productcategories
     * @return Response
     */
    public function index()
    {
        return response()->json(Productcategory::all());
    }

    /**
     * Display the specified resource.
     * GET /productcategories/{idproduct}
     * @param  int $idproductcategory
     * @return Response
     */
    public function show($idproductcategory)
    {
        return response()->json(Productcategory::find($idproductcategory));
    }


}