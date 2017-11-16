<?php

namespace SigeTurbo\Http\Controllers;

use Illuminate\Http\Response;
use SigeTurbo\Repositories\Observertype\ObservertypeRepositoryInterface;

class ObservertypesController extends Controller
{

    /**
     * @var ObservertypeRepositoryInterface
     */
    private $observertypeRepository;

    /**
     * ObservertypesController constructor.
     * @param ObservertypeRepositoryInterface $observertypeRepository
     */
    public function __construct(ObservertypeRepositoryInterface $observertypeRepository)
    {

        $this->observertypeRepository = $observertypeRepository;
    }

    /**
     * Display a listing of the resource.
     * GET /observertypes
     * @return Response
     */
    public function index()
    {
        return response()->json($this->observertypeRepository->all());
    }

    /**
     * Display the specified resource.
     * GET /observertypes/{idobservertype}
     * @param  int  idobservertype
     * @return Response
     */
    public function show($idobservertype)
    {
        return response()->json($this->observertypeRepository->find($idobservertype));
    }

}