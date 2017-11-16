<?php

namespace SigeTurbo\Http\Controllers;

use Illuminate\Http\Response;
use SigeTurbo\Repositories\Town\TownRepositoryInterface;

class TownsController extends Controller
{

    /**
     * @var TownRepositoryInterface
     */
    private $townRepository;

    /**
     * @param TownRepositoryInterface $townRepository
     */
    function __construct(TownRepositoryInterface $townRepository)
    {
        $this->townRepository = $townRepository;
    }

    /**
     * Display a listing of the resource.
     * GET /towns
     * @return Response
     */
    public function index()
    {
        return response()->json($this->townRepository->whereArea('Y'));
    }

    /**
     * Display the specified resource.
     * GET /towns/{idtown}
     * @param  int $idtown
     * @return Response
     */
    public function show($idtown)
    {
        return response()->json($this->townRepository->find($idtown));
    }

}