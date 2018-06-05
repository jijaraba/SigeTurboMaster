<?php

namespace SigeTurbo\Http\Controllers;

use Illuminate\Http\Request;
use SigeTurbo\Repositories\Cost\CostRepositoryInterface;

class CostsController extends Controller
{
    /**
     * @var CostRepositoryInterface
     */
    private $costRepository;

    /**
     * CostsController constructor.
     * @param CostRepositoryInterface $costRepository
     */
    public function __construct(CostRepositoryInterface $costRepository)
    {
        $this->costRepository = $costRepository;
    }

    /**
     * Display a listing of the resource.
     * GET /concepttypes
     * @param Request $request
     * @return Response
     */
    public function getCostsByPackage(Request $request)
    {
        return response()->json($this->costRepository->getCostsByPackage($request['year'], $request['grade'], $request['type'], $request['package']));
    }
}
