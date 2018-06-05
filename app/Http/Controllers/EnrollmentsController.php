<?php

namespace SigeTurbo\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\DB;
use SigeTurbo\Events\Stream;
use SigeTurbo\Http\Requests\EnrollmentNewRequest;
use SigeTurbo\Http\Requests\EnrollmentUpdateRequest;
use SigeTurbo\Repositories\Cost\CostRepositoryInterface;
use SigeTurbo\Repositories\Enrollment\EnrollmentRepositoryInterface;
use SigeTurbo\Repositories\Group\GroupRepositoryInterface;
use SigeTurbo\Repositories\Payment\PaymentRepositoryInterface;
use SigeTurbo\Repositories\User\UserRepositoryInterface;
use SigeTurbo\Repositories\Userfamily\UserfamilyRepositoryInterface;
use SigeTurbo\Repositories\Year\YearRepositoryInterface;
use SigeTurbo\Statusschooltype;


class EnrollmentsController extends Controller
{
    /**
     * @var EnrollmentRepositoryInterface
     */
    private $enrollmentRepository;
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;
    /**
     * @var GroupRepositoryInterface
     */
    private $groupRepository;
    /**
     * @var YearRepositoryInterface
     */
    private $yearRepository;
    /**
     * @var CostRepositoryInterface
     */
    private $costRepository;
    /**
     * @var UserfamilyRepositoryInterface
     */
    private $userfamilyRepository;
    /**
     * @var PaymentRepositoryInterface
     */
    private $paymentRepository;

    /**
     * EnrollmentsController constructor.
     * @param EnrollmentRepositoryInterface $enrollmentRepository
     * @param UserRepositoryInterface $userRepository
     * @param GroupRepositoryInterface $groupRepository
     * @param YearRepositoryInterface $yearRepository
     * @param CostRepositoryInterface $costRepository
     * @param UserfamilyRepositoryInterface $userfamilyRepository
     * @param PaymentRepositoryInterface $paymentRepository
     */
    public function __construct(EnrollmentRepositoryInterface $enrollmentRepository,
                                UserRepositoryInterface $userRepository,
                                GroupRepositoryInterface $groupRepository,
                                YearRepositoryInterface $yearRepository,
                                CostRepositoryInterface $costRepository,
                                UserfamilyRepositoryInterface $userfamilyRepository,
                                PaymentRepositoryInterface $paymentRepository)
    {
        $this->enrollmentRepository = $enrollmentRepository;
        $this->userRepository = $userRepository;
        $this->groupRepository = $groupRepository;
        $this->yearRepository = $yearRepository;
        $this->costRepository = $costRepository;
        $this->userfamilyRepository = $userfamilyRepository;
        $this->paymentRepository = $paymentRepository;
    }

    /**
     * Display a listing of the resource.
     * GET /enrollments
     * @return Response
     */
    public function index()
    {
        return response()->json($this->enrollmentRepository->all());
    }

    /**
     * Store a newly created resource in storage.
     * @param EnrollmentNewRequest $request
     * @return Response
     */
    public function store(EnrollmentNewRequest $request)
    {

        $data = [];

        //Save Enrollment
        DB::beginTransaction();
        try {
            //Update Reentry
            ($request["reentry"] == true) ? $request["reentry"] = "Y" : $request["reentry"] = "N";
            //Update Inclusion
            ($request["inclusion"] == true) ? $request["inclusion"] = "Y" : $request["inclusion"] = "N";
            //Update Fieldtrip
            ($request["fieldtrip"] == true) ? $request["fieldtrip"] = "Y" : $request["fieldtrip"] = "N";
            //Update Isapprovedyear
            ($request["isapprovedyear"] == true) ? $request["isapprovedyear"] = "Y" : $request["isapprovedyear"] = "N";

            //Update Enrollment
            $enrollment = $this->enrollmentRepository->store($request);

            if ($enrollment) {
                $data['successful'] = true;
                $data['message'] = Lang::get('sige.SuccessSaveMessage');
                $data['enrollment'] = $enrollment;
                //GENERATE PAYMENT
                if ($request['status'] == Statusschooltype::STATUS_PREENROLLMENT) {
                    //Find Costs
                    $cost = $this->costRepository->costByGroup($request["year"], $request["group"]);
                    //Find Student
                    $student = $this->enrollmentRepository->getEnrollmentsLatestByStudent($request["student"]);
                    //Find Family
                    $family = $this->userfamilyRepository->getFamilyByUser($student->iduser);
                    //Save Payment Individual
                    $this->paymentRepository->setPaymentIndividual($family->family, $this->paymentRepository->configDataPayment($request["year"], $request["group"], $cost, $student, null));
                }
                //Stream
                $user = $this->userRepository->find($request["student"]);
                $group = $this->groupRepository->find($request["group"]);
                event(new Stream(['description' => "asignó " . (($user->idgender == 1) ? " el estudiante " : " la estudiante ") . "$user->firstname $user->lastname al grupo $group->name"]));
                //Commit
                DB::commit();
                //Response
                return response()->json($data);
            }
            return response()->json($data);
        } catch (\Exception $e) {
            DB::rollback();
            $data['unsuccessful'] = true;
            $data['message'] = Lang::get('sige.ErrorSaveMessage');
            return response()->json($data);
        }
    }

    /**
     * Display the specified resource.
     * GET /enrollments/{idenrollment}
     * @param  int $idenrollment
     * @return Response
     */
    public function show($idenrollment)
    {
        return response()->json($this->enrollmentRepository->find($idenrollment));
    }

    /**
     * Update the specified resource in storage.
     * @param $enrollment
     * @param EnrollmentUpdateRequest $request
     * @return Response
     * @internal param $idenrollment
     */
    public function update($enrollment, EnrollmentUpdateRequest $request)
    {
        //Update Reentry
        ($request["reentry"] == true) ? $request["reentry"] = "Y" : $request["reentry"] = "N";
        //Update Inclusion
        ($request["inclusion"] == true) ? $request["inclusion"] = "Y" : $request["inclusion"] = "N";
        //Update Fieldtrip
        ($request["fieldtrip"] == true) ? $request["fieldtrip"] = "Y" : $request["fieldtrip"] = "N";
        //Update Isapprovedyear
        ($request["isapprovedyear"] == true) ? $request["isapprovedyear"] = "Y" : $request["isapprovedyear"] = "N";

        //Update Enrollment
        $enrollment = $this->enrollmentRepository->update($enrollment, $request);

        $data = [];
        if ($enrollment) {
            $data['successful'] = true;
            $data['message'] = Lang::get('sige.SuccessUpdateMessage');
        } else {
            $data['unsuccessful'] = true;
            $data['message'] = Lang::get('sige.ErrorUpdateMessage');
        }
        return response()->json($data);
    }

    /**
     * Get Enrollments by Year and Group
     * @param $idyear
     * @param $idgroup
     * @return mixed
     */
    public function getenrollments($idyear, $idgroup)
    {
        return response()->json($this->enrollmentRepository->getEnrollments($idyear, (int)$idgroup));
    }

    /**
     * Get Enrollments By Students With Cost
     * @param Request $request
     * @return mixed
     */
    public function getEnrollmentLatestByStudentWithCost(Request $request)
    {
        return response()->json($this->enrollmentRepository->getEnrollmentLatestByStudentWithCost($request['student'], $request['year']));
    }

    /**
     * Get Enrollments By Students
     * @param Request $request
     * @return mixed
     */
    public function getEnrollmentsLatestByStudent(Request $request)
    {
        return response()->json($this->enrollmentRepository->getEnrollmentsLatestByStudent($request['student']));
    }

    /**
     * Get Enrollments By Students
     * @param Request $request
     * @return mixed
     */
    public function getEnrollmentsByStudent(Request $request)
    {
        return response()->json($this->enrollmentRepository->getEnrollmentsByStudent($request['student']));
    }

    /**
     * Get Enrollments With Data by Year and Group and Subject and Nivel With Attendance And Grade
     * @param $idyear
     * @param $idperiod
     * @param $idgroup
     * @param $idsubject
     * @param $idnivel
     * @return mixed
     */
    public function getEnrollmentsWithData($idyear, $idperiod, $idgroup, $idsubject, $idnivel)
    {
        return response()->json($this->enrollmentRepository
            ->getEnrollmentsWithData($idyear, $idperiod, $idgroup, $idsubject, $idnivel));
    }

    /**
     * Get Enrollments With Data by Year and Group and Subject and Nivel With Partial
     * @param $idyear
     * @param $idperiod
     * @param $idgroup
     * @param $idsubject
     * @param $idnivel
     * @return mixed
     */
    public function getEnrollmentsWithPartial($idyear, $idperiod, $idgroup, $idsubject, $idnivel)
    {
        return response()->json($this->enrollmentRepository
            ->getEnrollmentsWithPartial($idyear, $idperiod, $idgroup, $idsubject, $idnivel));
    }

    /**
     * Get Enrollments With Data by Year and Group and Subject and Nivel With Descriptive Report
     * @param $idyear
     * @param $idperiod
     * @param $idgroup
     * @param $idsubject
     * @param $idnivel
     * @return mixed
     */
    public function getEnrollmentsWithDescriptivereport($idyear, $idperiod, $idgroup, $idsubject, $idnivel)
    {
        return response()->json($this->enrollmentRepository
            ->getEnrollmentsWithDescriptivereport($idyear, $idperiod, $idgroup, $idsubject, $idnivel));
    }

    /**
     * Get Enrollments With Data by Year and Group and Subject and Nivel
     * @param $idyear
     * @param $idperiod
     * @param $idgroup
     * @param $idsubject
     * @param $idnivel
     * @return mixed
     */
    public function getEnrollmentsWithAttendance($idyear, $idperiod, $idgroup, $idsubject, $idnivel, Request $request)
    {
        return response()->json($this->enrollmentRepository
            ->getEnrollmentsWithAttendance($idyear, $idperiod, $idgroup, $idsubject, $idnivel, $request['date']));
    }

    /**
     * Get Enrollments With Data by Year and Group and Subject and Nivel
     * @param $idyear
     * @param $idperiod
     * @param $idgroup
     * @param $idsubject
     * @param $idnivel
     * @return mixed
     */
    public function getEnrollmentsWithGrades($idyear, $idperiod, $idgroup, $idsubject, $idnivel)
    {
        return response()->json($this->enrollmentRepository
            ->getEnrollmentsWithGrades($idyear, $idperiod, $idgroup, $idsubject, $idnivel));
    }

    /**
     * Get Enrollments With Observers
     * @param $idyear
     * @param $idgroup
     * @return mixed
     */
    public function getEnrollmentsWithObservers($idyear, $idgroup)
    {
        return response()->json($this->enrollmentRepository
            ->getEnrollmentsWithObservers($idyear, $idgroup));
    }

    /**
     * Get Enrollments by Year and Group To Attendances List
     * @param $idyear
     * @param $idgroup
     * @return mixed
     */
    public function getenrollmentsAtendanccesslist($idyear, $idgroup)
    {
        return response()->json($this->enrollmentRepository->getEnrollmentAttendacessList($idyear, (int)$idgroup));
    }

    /**
     * Get Enrollments By Status
     * @param Request $request
     * @return mixed
     */
    public function getEnrollmentsByStatus(Request $request)
    {
        return response()->json($this->enrollmentRepository
            ->getEnrollmentsByStatus($this->yearRepository->getCurrentYear()->idyear, $request["status"]));
    }

}