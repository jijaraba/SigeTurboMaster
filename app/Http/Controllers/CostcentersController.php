<?php

namespace SigeTurbo\Http\Controllers;

use Illuminate\Http\Request;
use SigeTurbo\Repositories\Costcenter\CostcenterRepositoryInterface;

class CostcentersController extends Controller
{
    /**
     * @var CostcenterRepositoryInterface
     */
    private $costcenterRepository;

    /**
     * CostcentersController constructor.
     * @param CostcenterRepositoryInterface $costcenterRepository
     */
    public function __construct(CostcenterRepositoryInterface $costcenterRepository)
    {
        $this->costcenterRepository = $costcenterRepository;
    }

    /**
     * Get Costcenters By Student
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCostcenterByStudent(Request $request)
    {
        return response()->json($this->costcenterRepository->getCostcenterByStudent($request['student']));
    }

}
