<?php

namespace SigeTurbo\Http\Controllers;

use Illuminate\Http\Response;
use SigeTurbo\Repositories\Statuspurchase\StatuspurchaseRepositoryInterface;

class StatuspurchasesController extends Controller
{
    /**
     * @var StatuspurchaseRepositoryInterface
     */
    private $statuspurchaseRepository;

    /**
     * StatuspurchasesController constructor.
     * @param StatuspurchaseRepositoryInterface $statuspurchaseRepository
     */
    public function __construct(StatuspurchaseRepositoryInterface $statuspurchaseRepository)
    {
        $this->statuspurchaseRepository = $statuspurchaseRepository;
    }

    /**
     * Display a listing of the resource.
     * GET /statuspurchases
     * @return Response
     */
    public function index()
    {
        return response()->json($this->statuspurchaseRepository->all());
    }

    /**
     * Display the specified resource.
     * GET /statuspurchases/{idstatuspurchase}
     * @param  int  idstatuspurchase
     * @return Response
     */
    public function show($idstatuspurchase)
    {
        return response()->json($this->statuspurchaseRepository->find($idstatuspurchase));
    }


}