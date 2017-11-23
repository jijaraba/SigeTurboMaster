<?php

namespace SigeTurbo\Http\Controllers;

use Illuminate\Http\Request;
use SigeTurbo\Repositories\Enrollment\EnrollmentRepositoryInterface;

class GroupdirectorViewController extends Controller
{
    /**
     * @var EnrollmentRepositoryInterface
     */
    private $enrollmentRepository;

    /**
     * GroupdirectorViewController constructor.
     * @param EnrollmentRepositoryInterface $enrollmentRepository
     */
    public function __construct(EnrollmentRepositoryInterface $enrollmentRepository)
    {
        $this->enrollmentRepository = $enrollmentRepository;
    }

    /**
     * Display a listing of the resource.
     * GET /view/groupdirector
     * @return Response
     */
    public function index()
    {
        return view('view/groupdirector/index');
    }

    /**
     * Display a listing of the resource.
     * GET /view/groupdirector
     * @param $student
     * @return Response
     */
    public function student($student)
    {
        return view('view/groupdirector/student')
            ->withEnrollment($this->enrollmentRepository->getEnrollmentsLatestByStudent($student));
    }

}
