<?php

namespace SigeTurbo\Http\Controllers;

use Illuminate\Http\Response;
use SigeTurbo\Repositories\Year\YearRepositoryInterface;


class YearsController extends Controller
{
    /**
     * @var YearRepositoryInterface
     */
    private $yearRepository;

    /**
     * YearsController constructor.
     * @param YearRepositoryInterface $yearRepository
     */
    public function __construct(YearRepositoryInterface $yearRepository)
    {
        $this->yearRepository = $yearRepository;
    }

    /**
     * Display a listing of the resource.
     * GET /years
     * @return Response
     */
    public function index()
    {
        return response()->json($this->yearRepository->all());
    }

    /**
     * Display the specified resource.
     * GET /years/{idyear}
     * @param  int $idyear
     * @return Response
     */
    public function show($idyear)
    {
        return response()->json($this->yearRepository->find($idyear));
    }

    /**
     * Get Current Year
     * @return mixed
     */
    public function getcurrentyear()
    {
        return response()->json($this->yearRepository->getCurrentYear());
    }

    /**
     * Get Current Preregistration
     * @return mixed
     */
    public function getCurrentPreregistration()
    {
        return response()->json($this->yearRepository->getCurrentPreregistration());
    }

}