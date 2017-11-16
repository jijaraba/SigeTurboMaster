<?php

namespace SigeTurbo\Http\Controllers;

use SigeTurbo\Repositories\Year\YearRepositoryInterface;

class AdmissionsController extends Controller
{
    /**
     * @var YearRepositoryInterface
     */
    private $yearRepository;

    /**
     * AdmissionsController constructor.
     * @param YearRepositoryInterface $yearRepository
     */
    public function __construct(YearRepositoryInterface $yearRepository)
    {
        $this->yearRepository = $yearRepository;
    }

    public function index()
    {
        return view('admissions.index')
            ->withYear($this->yearRepository->getCurrentYear()->idyear);
    }


}