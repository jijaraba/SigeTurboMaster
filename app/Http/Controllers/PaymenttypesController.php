<?php

namespace SigeTurbo\Http\Controllers;

use Illuminate\Http\Request;
use SigeTurbo\Repositories\Paymenttype\PaymenttypeRepositoryInterface;

class PaymenttypesController extends Controller
{
    /**
     * @var PaymenttypeRepositoryInterface
     */
    private $paymenttypeRepository;

    /**
     * PaymenttypesController constructor.
     * @param PaymenttypeRepositoryInterface $paymenttypeRepository
     */
    public function __construct(PaymenttypeRepositoryInterface $paymenttypeRepository)
    {
        $this->paymenttypeRepository = $paymenttypeRepository;
    }

    public function index()
    {
        return response()->json($this->paymenttypeRepository->all());
    }
}
