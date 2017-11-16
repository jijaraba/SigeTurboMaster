<?php

namespace SigeTurbo\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;


class VotesController extends Controller
{

    /**
     * Display a listing of the resource.
     * GET /years
     * @return Response
     */
    public function index()
    {
       // return response()->json($this->yearRepository->all());
    }

    /**
     * Display a listing of the resource.
     * GET /votes
     * @return Response
     */
    public function init(Request $request)
    {
        //dd($request);
        $search = [
            'page' => 1,
            'option' => 'votes'
        ];
        return view('contracts.init')
           // ->withPendings($paginator)
            ->withSearch($search);
    }

}