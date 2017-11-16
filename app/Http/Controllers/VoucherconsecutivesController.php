<?php

namespace SigeTurbo\Http\Controllers;

use Illuminate\Http\Request;
use SigeTurbo\Repositories\Voucherconsecutive\VoucherconsecutiveRepositoryInterface;


class VoucherconsecutivesController extends Controller
{
    /**
     * @var VoucherconsecutiveRepositoryInterface
     */
    private $voucherconsecutiveRepository;

    /**
     * FinancialdocumentsController constructor.
     * @param VoucherconsecutiveRepositoryInterface $voucherconsecutiveRepository
     */
    public function __construct(VoucherconsecutiveRepositoryInterface $voucherconsecutiveRepository)
    {
        $this->voucherconsecutiveRepository = $voucherconsecutiveRepository;
    }


    /**
     * Get Voucherconsecutive By Code
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getVoucherConsecutiveByCode(Request $request)
    {
        return response()->json($this->voucherconsecutiveRepository->getVoucherConsecutiveByCode($request['code']));
    }
}
