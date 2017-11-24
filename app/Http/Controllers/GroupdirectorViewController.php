<?php

namespace SigeTurbo\Http\Controllers;

use Illuminate\Http\Request;
use SigeTurbo\Repositories\Enrollment\EnrollmentRepositoryInterface;
use SigeTurbo\Repositories\Groupdirector\GroupdirectorRepositoryInterface;
use SigeTurbo\Repositories\Year\YearRepositoryInterface;

class GroupdirectorViewController extends Controller
{
    /**
     * @var EnrollmentRepositoryInterface
     */
    private $enrollmentRepository;
    /**
     * @var GroupdirectorRepositoryInterface
     */
    private $groupdirectorRepository;
    /**
     * @var YearRepositoryInterface
     */
    private $yearRepository;

    /**
     * GroupdirectorViewController constructor.
     * @param EnrollmentRepositoryInterface $enrollmentRepository
     * @param GroupdirectorRepositoryInterface $groupdirectorRepository
     * @param YearRepositoryInterface $yearRepository
     */
    public function __construct(EnrollmentRepositoryInterface $enrollmentRepository,
                                GroupdirectorRepositoryInterface $groupdirectorRepository,
                                YearRepositoryInterface $yearRepository)
    {
        $this->enrollmentRepository = $enrollmentRepository;
        $this->groupdirectorRepository = $groupdirectorRepository;
        $this->yearRepository = $yearRepository;
    }

    /**
     * Display a listing of the resource.
     * GET /view/groupdirector
     * @return Response
     */
    public function index()
    {
        return view('view/groupdirector/index')
            ->withGroup($this->groupdirectorRepository->getGroup(2017, getUser()->iduser));
    }

    /**
     * Display a listing of the resource.
     * GET /view/groupdirector
     * @param $student
     * @return Response
     */
    public function student($student)
    {

        //Report Type
        $type = "finalreport";
        //Find Group
        $group = $this->groupdirectorRepository->getGroup(2017, getUser()->iduser);
        if ($group->idgroup < 11) {
            $type = "descriptivereport";
        }

        return view('view/groupdirector/student')
            ->withEnrollment($this->enrollmentRepository->getEnrollmentsLatestByStudent($student))
            ->withGroup($group)
            ->withType($type);
    }

}
