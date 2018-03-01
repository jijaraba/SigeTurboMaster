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
use SigeTurbo\Repositories\Payment\PaymentRepository;
use SigeTurbo\Repositories\Payment\PaymentRepositoryInterface;
use SigeTurbo\Repositories\Userfamily\UserfamilyRepositoryInterface;


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
     * @param UserfamilyRepositoryInterface $userfamilyRepository
     * @param PaymentRepositoryInterface $paymentRepository
     */
    function __construct(UserfamilyRepositoryInterface $userfamilyRepository, PaymentRepositoryInterface $paymentRepository)
    {
        $this->userfamilyRepository = $userfamilyRepository;
        $this->paymentRepository = $paymentRepository;
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
        $payments = $this->paymentRepository->getPaymentsPendingsByUser(getUser()->iduser, true, null, 'ASC', true);
        if (count($payments) > 0) {
            $request->session()->flash('error', Lang::get('sige.PaymentsPendingTitle'));
            App::abort(401, 'payments_pending');
        }

        $data = ['user' => getUser()->iduser, 'category' => Category::STUDENT];
        $users = (array)$this->userfamilyRepository->getUsersByFamily($data);
        return view('userfamilies.indexparentsbyhomeworks')->withUsers($users);
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
        $payments = $this->paymentRepository->getPaymentsPendingsByUser(getUser()->iduser, true, null, 'ASC', true);
        if (count($payments) > 0) {
            $request->session()->flash('error', Lang::get('sige.PaymentsPendingTitle'));
            App::abort(401, 'payments_pending');
        }

        $data = ['user' => getUser()->iduser, 'category' => Category::STUDENT];
        $users = (array)$this->userfamilyRepository->getUsersByFamily($data);
        return view('userfamilies.indexparentsbymonitorings')->withUsers($users);
    }


    /**
     * Display all members per family.
     * GET /userfamilies
     * @param Request $request
     * @return Response
     */
    public function indexParentsByUpdateInfo(Request $request)
    {
        //Verify Payments
        $payments = $this->paymentRepository->getPaymentsPendingsByUser(getUser()->iduser, true, null, 'ASC', true);
        if (count($payments) > 0) {
            $request->session()->flash('error', Lang::get('sige.PaymentsPendingTitle'));
            App::abort(401, 'payments_pending');
        }

        $data = ['user' => getUser()->iduser];
        $users = (array)$this->userfamilyRepository->getUsersByFamily($data);
        return view('userfamilies.indexparentsbyupdateinfo')->withUsers($users);
    }

    /**
     * Display the specified resource.
     * GET /userfamilies/{iduserfamily}
     * @param  int $iduserfamily
     * @return Response
     */
    public function show($iduserfamily)
    {
        return response()->json($this->userfamilyRepository->find($iduserfamily));
    }

    /**
     * Get Users By Family
     * @param Request $request
     * @return mixed
     */
    public function getUsersByFamily(Request $request)
    {
        return response()->json($this->userfamilyRepository->getUsersByFamily($request));
    }


}