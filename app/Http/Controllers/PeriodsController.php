<?php

namespace SigeTurbo\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use SigeTurbo\Repositories\Period\PeriodRepositoryInterface;

class PeriodsController extends Controller
{
    /**
     * @var PeriodRepositoryInterface
     */
    private $periodRepository;

    /**
     * PeriodsController constructor.
     * @param PeriodRepositoryInterface $periodRepository
     */
    public function __construct(PeriodRepositoryInterface $periodRepository)
    {
        $this->periodRepository = $periodRepository;
    }


    /**
     * Display a listing of the resource.
     * GET /periods
     * @return Response
     */
    public function index()
    {
        return response()->json($this->periodRepository->all());
    }

    /**
     * Display the specified resource.
     * GET /periods/{id}
     * @param  int $idperiod
     * @return Response
     */
    public function show($idperiod)
    {
        return response()->json($this->periodRepository->find($idperiod));
    }

    /**
     * Get Periods By Year
     * @param Request $request
     * @return mixed
     */
    public function getperiodsbyyear(Request $request)
    {
        if (Session::get('role') == 'Teacher') {
            return response()->json($this->periodRepository->getPeriodsByYear($request['year'], getUser()->iduser));
        } else {
            return response()->json($this->periodRepository->getPeriodsByYear($request['year']));
        }
    }

    /**
     * Get Current Period
     * @return mixed
     */
    public function getcurrentperiod()
    {
        return response()->json($this->periodRepository->getCurrentPeriod());
    }

}