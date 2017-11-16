<?php

namespace SigeTurbo\Http\Controllers;

use Illuminate\Http\Request;
use SigeTurbo\Repositories\Bank\BankRepositoryInterface;

class BanksController extends Controller
{
    /**
     * @var BankRepositoryInterface
     */
    private $bankRepository;

    /**
     * BanksController constructor.
     * @param BankRepositoryInterface $bankRepository
     */
    public function __construct(BankRepositoryInterface $bankRepository)
    {
        $this->bankRepository = $bankRepository;
    }

    /**
     * Display a listing of the resource.
     * GET /banks
     * @return Response
     */
    public function index()
    {
        return response()->json($this->bankRepository->all());
    }

    /**
     * Display the specified resource.
     * GET /banks/{bank}
     * @param int $bank
     * @return Response
     */
    public function show($bank)
    {
        return response()->json($this->bankRepository->find($bank));
    }

}
