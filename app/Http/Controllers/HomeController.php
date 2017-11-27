<?php

namespace SigeTurbo\Http\Controllers;

use SigeTurbo\Repositories\Attendance\AttendanceRepositoryInterface;
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
     * HomeController constructor.
     * @param AttendanceRepositoryInterface $attendanceRepository
     * @param YearRepositoryInterface $yearRepository
     */
    public function __construct(AttendanceRepositoryInterface $attendanceRepository,
                                YearRepositoryInterface $yearRepository)
    {
        $this->attendanceRepository = $attendanceRepository;
        $this->yearRepository = $yearRepository;
    }

    /**
     * Dashboard
     * @return $this
     */
    public function dashboard()
    {
        return view('home.dashboard')
            ->with('attendances',$this->attendanceRepository->getAttendancesAmount())
            ->withYear($this->yearRepository->getCurrentYear()->idyear);
    }

}
