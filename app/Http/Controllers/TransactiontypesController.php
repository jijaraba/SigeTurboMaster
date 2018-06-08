<?php

namespace SigeTurbo\Http\Controllers;

use Illuminate\Http\Request;
use SigeTurbo\Http\Requests;
use SigeTurbo\Repositories\Transactiontype\TransactiontypeRepositoryInterface;

class TransactiontypesController extends Controller
{
    /**
     * @var TransactiontypeRepositoryInterface
     */
    private $transactiontypeRepository;

    /**
     * TransactiontypesController constructor.
     * @param TransactiontypeRepositoryInterface $transactiontypeRepository
     */
    public function __construct(TransactiontypeRepositoryInterface $transactiontypeRepository)
    {
        $this->transactiontypeRepository = $transactiontypeRepository;
    }

    public function index()
    {
        return response()->json($this->transactiontypeRepository->all());
    }
}
