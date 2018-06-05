<?php

namespace SigeTurbo\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use SigeTurbo\Http\Requests;
use SigeTurbo\Repositories\Payment\PaymentRepositoryInterface;
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
     * @var PaymentRepositoryInterface
     */
    private $paymentRepository;

    /**
     * FinancialsController constructor.
     * @param YearRepositoryInterface $yearRepository
     * @param UserRepositoryInterface $userRepository
     * @param PaymentRepositoryInterface $paymentRepository
     */
    public function __construct(YearRepositoryInterface $yearRepository,
                                UserRepositoryInterface $userRepository,
                                PaymentRepositoryInterface $paymentRepository)
    {
        $this->yearRepository = $yearRepository;
        $this->userRepository = $userRepository;
        $this->paymentRepository = $paymentRepository;
    }

    public function index()
    {
        return view('financials.index')
            ->withYear($this->yearRepository->getCurrentYear()->idyear)
            ->withServerdate(Carbon::now()->timestamp)
            ->withPayments($this->paymentRepository->getPaymentsPending());
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
