<?php

namespace SigeTurbo\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Lang;
use SigeTurbo\Category;
use SigeTurbo\Http\Requests\UserfamilyRequest;
use SigeTurbo\Repositories\Enrollment\EnrollmentRepositoryInterface;
use SigeTurbo\Repositories\Payment\PaymentRepository;
use SigeTurbo\Repositories\Payment\PaymentRepositoryInterface;
use SigeTurbo\Repositories\Preregistration\PreregistrationRepositoryInterface;
use SigeTurbo\Repositories\User\UserRepositoryInterface;
use SigeTurbo\Repositories\Userfamily\UserfamilyRepositoryInterface;
use SigeTurbo\Repositories\Year\YearRepositoryInterface;


/**
 * Class UserfamiliesController
 */
class UserfamiliesController extends Controller
{
    /**
     * @var UserfamilyRepositoryInterface
     */
    private $userfamilyRepository;
    /**
     * @var PaymentRepositoryInterface
     */
    private $paymentRepository;
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;
    /**
     * @var PreregistrationRepositoryInterface
     */
    private $preregistrationRepository;
    /**
     * @var YearRepositoryInterface
     */
    private $yearRepository;
    /**
     * @var EnrollmentRepositoryInterface
     */
    private $enrollmentRepository;

    /**
     * @param UserfamilyRepositoryInterface $userfamilyRepository
     * @param PaymentRepositoryInterface $paymentRepository
     * @param UserRepositoryInterface $userRepository
     * @param PreregistrationRepositoryInterface $preregistrationRepository
     * @param YearRepositoryInterface $yearRepository
     * @param EnrollmentRepositoryInterface $enrollmentRepository
     */
    function __construct(UserfamilyRepositoryInterface $userfamilyRepository,
                         PaymentRepositoryInterface $paymentRepository,
                         UserRepositoryInterface $userRepository,
                         PreregistrationRepositoryInterface $preregistrationRepository,
                         YearRepositoryInterface $yearRepository,
                         EnrollmentRepositoryInterface $enrollmentRepository)
    {
        $this->userfamilyRepository = $userfamilyRepository;
        $this->paymentRepository = $paymentRepository;
        $this->userRepository = $userRepository;
        $this->preregistrationRepository = $preregistrationRepository;
        $this->yearRepository = $yearRepository;
        $this->enrollmentRepository = $enrollmentRepository;
    }

    /**
     * Display all members per family.
     * GET /userfamilies
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $users = $this->userfamilyRepository->getUsersByFamily($request);
        return view('userfamilies.index')->withUsers($users);
    }

    /**
     * Store a newly created resource in storage.
     * @param UserfamilyRequest $request
     * @return Response
     */
    public function assign(UserfamilyRequest $request)
    {

        //Save Userfamily
        $userfamily = $this->userfamilyRepository->store($request);

        $data = [];
        if ($userfamily) {
            $data['successful'] = true;
            $data['message'] = Lang::get('sige.SuccessSaveMessage');
            $data['family'] = $userfamily;
            //Delete Cache
            Cache::forget('families');
            Cache::forget('userfamilies');
        } else {
            $data['unsuccessful'] = true;
            $data['message'] = Lang::get('sige.ErrorSaveMessage');
        }
        return redirect()
            ->route('admissions.students.edit', ['student' => $request['user']])
            ->withSuccess(Lang::get('sige.SuccessUpdateMessage'));
    }

    /**
     * Display all members per family.
     * GET /userfamilies
     * @param Request $request
     * @return Response
     */
    public function indexParentsByHomeworks(Request $request)
    {

        //Verify Payments
        $payments = $this->paymentRepository->getPaymentsPendingByUser(getUser()->iduser, true, null, 'ASC', true);
        if (count($payments) > 0) {
            $request->session()->flash('error', Lang::get('sige.PaymentsPendingTitle'));
            App::abort(401, 'payments_pending');
        }

        $data = ['user' => getUser()->iduser, 'category' => Category::STUDENT];
        $users = (array)$this->userfamilyRepository->getUsersByFamily($data);
        return view('userfamilies.homeworks')->withUsers($users);
    }

    /**
     * Display all members per family.
     * GET /userfamilies
     * @param Request $request
     * @return Response
     */
    public function indexParentsByMonitorings(Request $request)
    {

        //Verify Payments
        $payments = $this->paymentRepository->getPaymentsPendingByUser(getUser()->iduser, true, null, 'ASC', true);
        if (count($payments) > 0) {
            $request->session()->flash('error', Lang::get('sige.PaymentsPendingTitle'));
            App::abort(401, 'payments_pending');
        }

        $data = ['user' => getUser()->iduser, 'category' => Category::STUDENT];
        $users = (array)$this->userfamilyRepository->getUsersByFamily($data);
        return view('userfamilies.monitorings')->withUsers($users);
    }


    /**
     * Display all members per family.
     * GET /members
     * @param Request $request
     * @return Response
     */
    public function members(Request $request)
    {

        //Verify Payments
        $payments = $this->paymentRepository->getPaymentsPendingByUser(getUser()->iduser, true, null, 'ASC', true);
        if (count($payments) > 0) {
            $request->session()->flash('error', Lang::get('sige.PaymentsPendingTitle'));
            App::abort(401, 'payments_pending');
        }

        $data = ['user' => getUser()->iduser];
        $users = (array)$this->userfamilyRepository->getUsersByFamily($data);
        return view('userfamilies.members')
            ->withUsers($users);
    }

    /**
     * Get Info Profile
     * @param $token
     * @param Request $request
     * @return mixed
     */
    public function memberProfile($token, Request $request)
    {

        //Verify Token
        $user = $this->userRepository->getUserByToken($token);

        //Verify Payments
        $payments = $this->paymentRepository->getPaymentsPendingByUser(getUser()->iduser, true, null, 'ASC', true);
        if (count($payments) > 0) {
            $request->session()->flash('error', Lang::get('sige.PaymentsPendingTitle'));
            App::abort(401, 'payments_pending');
        }

        //Verify Preregistration by student
        $year = $this->yearRepository::getCurrentYear();
        if (isset($user->iduser) && $user->idcategory == Category::STUDENT) {
            $preregistration = $this->yearRepository->getCurrentPreregistration();
            if (isset($preregistration->idyear)) {
                $enrollment = $this->enrollmentRepository->getEnrollmentByYearAndUser($preregistration->idyear, $user->iduser);
                if (!isset($enrollment->iduser)) {
                    $request->session()->flash('error', Lang::get('sige.StudentPreregistrationError', ['student' => $user->firstname, 'year' => $preregistration->name]));
                    App::abort(401, 'enrollment_error');
                }
            } elseif (isset($year->idyear)) {
                $enrollment = $this->enrollmentRepository->getEnrollmentByYearAndUser($year->idyear, $user->iduser);
                if (!isset($enrollment->iduser)) {
                    $request->session()->flash('error', Lang::get('sige.StudentEnrollmentError',['student' => $user->firstname, 'year' => $year->name]));
                    App::abort(401, 'enrollment_error');
                }
            }
        }


        //Get Information By User
        if (isset($user->iduser)) {
            $preregistration = $this->preregistrationRepository->getPreregistrationByUser($user->iduser);
            if (isset($preregistration->iduser)) {
                return view('userfamilies.profile')
                    ->withUser($user)
                    ->withPreregistration($preregistration);
            } else {
                //Save Preregistration
                $preregistration = $this->preregistrationRepository->store($user);
                return view('userfamilies.profile')
                    ->withUser($user)
                    ->withPreregistration($preregistration);
            }
        } else {
            return redirect()
                ->route('parents.members.index')
                ->withErrors(Lang::get('sige.ErrorNotUser'));

        }

    }

    /**
     * Display the specified resource.
     * GET /userfamilies/{iduserfamily}
     * @param  int $iduserfamily
     * @return Response
     */
    public
    function show($iduserfamily)
    {
        return response()->json($this->userfamilyRepository->find($iduserfamily));
    }

    /**
     * Get Users By Family
     * @param Request $request
     * @return mixed
     */
    public
    function getUsersByFamily(Request $request)
    {
        return response()->json($this->userfamilyRepository->getUsersByFamily($request));
    }


}