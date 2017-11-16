<?php

namespace SigeTurbo\Http\Controllers;

use Illuminate\Http\Request;
use SigeTurbo\Repositories\Area\AreaRepositoryInterface;
use Illuminate\Http\Response;
use SigeTurbo\Area;

class AreasController extends Controller
{
    /**
     * @var AreaRepositoryInterface
     */
    private $areaRepository;

    /**
     * AreasController constructor.
     * @param AreaRepositoryInterface $areaRepository
     */
    public function __construct(AreaRepositoryInterface $areaRepository)
    {
        $this->areaRepository = $areaRepository;
    }


    /**
     * Display a listing of the resource.
     * GET /areas
     * @return Response
     */
    public function index()
    {
        //$areamodel = new Area();
        return response()->json(Area::allareas());

    }

    /**
     * Display the specified resource.
     * GET /areas/{idarea}
     * @param  int $idarea
     * @return Response
     */
    public function show($idarea)
    {
        return response()->json(Area::find($idarea));
    }

    /**
     * Display the specified resource.
     * GET /areas/{idyear}
     * @param Request $request
     * @return Response
     */
    public function getareasbyyear(Request $request)
    {
       return response()->json($this->areaRepository->getAreasByYear($request['year']));
    }


}