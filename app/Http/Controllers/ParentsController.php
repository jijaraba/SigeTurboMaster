<?php

namespace SigeTurbo\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use SigeTurbo\Repositories\Payment\PaymentRepositoryInterface;

class ParentsController extends Controller
{
    /**
     * @var PaymentRepositoryInterface
     */
    private $paymentRepository;

    /**
     * ParentsController constructor.
     * @param PaymentRepositoryInterface $paymentRepository
     */
    public function __construct(PaymentRepositoryInterface $paymentRepository)
    {
        $this->paymentRepository = $paymentRepository;
    }

    /**
     * Display a listing of the resource.
     * GET /parents
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $payments = $this->paymentRepository->getPaymentsPendingByUser(getUser()->iduser, true, null, 'ASC', true);
        if (count($payments) > 0) {
            $request->session()->flash('error', Lang::get('sige.PaymentsPendingTitle'));
            App::abort(401, 'payments_pending');
        }

        return view('parents.index');
    }

}