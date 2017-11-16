<?php

namespace SigeTurbo\Http\Controllers;

use Illuminate\Http\Request;
use SigeTurbo\Http\Requests;
use SigeTurbo\Repositories\User\UserRepositoryInterface;
use SigeTurbo\Repositories\Year\YearRepositoryInterface;

class FinancialsController extends Controller
{
    /**
     * @var YearRepositoryInterface
     */
    private $yearRepository;
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    /**
     * FinancialsController constructor.
     * @param YearRepositoryInterface $yearRepository
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(YearRepositoryInterface $yearRepository,
                                UserRepositoryInterface $userRepository)
    {
        $this->yearRepository = $yearRepository;
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        return view('financials.index')
            ->withYear($this->yearRepository->getCurrentYear()->idyear);
    }

    /**
     * @param $student
     * @param Request $request
     * @return mixed
     */
    public function transactions($student, Request $request)
    {
        return view('financials.transactions')
            ->withStudent($this->userRepository->getStudentById($student))
            ->withYear($request['year'])
            ->withSearch($request['search'])
            ->withView($request['view'])
            ->withSort($request['sort'])
            ->withOrder($request['order'])
            ->withPage($request['page']);
    }
}
