<?php

namespace SigeTurbo\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use SigeTurbo\Repositories\Attendance\AttendanceRepositoryInterface;
use Illuminate\Support\Facades\Lang;
use SigeTurbo\Repositories\Payment\PaymentRepositoryInterface;
use SigeTurbo\Repositories\Year\YearRepositoryInterface;

class HomeController extends Controller
{
    /**
     * @var AttendanceRepositoryInterface
     */
    private $attendanceRepository;
    /**
     * @var YearRepositoryInterface
     */
    private $yearRepository;
    /**
     * @var PaymentRepositoryInterface
     */
    private $paymentRepository;

    /**
     * HomeController constructor.
     * @param AttendanceRepositoryInterface $attendanceRepository
     * @param YearRepositoryInterface $yearRepository
     * @param PaymentRepositoryInterface $paymentRepository
     */
    public function __construct(AttendanceRepositoryInterface $attendanceRepository,
                                YearRepositoryInterface $yearRepository,
                                PaymentRepositoryInterface $paymentRepository)
    {
        $this->attendanceRepository = $attendanceRepository;
        $this->yearRepository = $yearRepository;
        $this->paymentRepository = $paymentRepository;
    }

    /**
     * Dashboard
     * @param Request $request
     * @return $this
     */
    public function dashboard(Request $request)
    {

        //Verify Payments
        if (getUser()->role == 'Parents') {
            $payments = $this->paymentRepository->getPaymentsPendingsByUser(getUser()->iduser, true, null, 'ASC', true);
            if (count($payments) > 0) {
                $request->session()->flash('error', Lang::get('sige.PaymentsPendingTitle'));
                App::abort(401, 'payments_pending');
            }
        }

        return view('home.dashboard')
            ->with('attendances', $this->attendanceRepository->getAttendancesAmount())
            ->withYear($this->yearRepository->getCurrentYear()->idyear);
    }

}
