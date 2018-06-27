<?php

namespace SigeTurbo\Http\Controllers;

use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use SigeTurbo\Accounttype;
use SigeTurbo\Category;
use SigeTurbo\Concepttype;
use SigeTurbo\Http\Requests\PaymentIndividualRequest;
use SigeTurbo\Http\Requests\PaymentMassiveRequest;
use SigeTurbo\Http\Requests\PaymentRequest;
use SigeTurbo\Http\Requests\PaymentRespondRequest;
use SigeTurbo\Http\Requests\PaymentShortRequest;
use SigeTurbo\Mailer\MailerInterface;
use SigeTurbo\Package;
use SigeTurbo\Repositories\Cost\CostRepositoryInterface;
use SigeTurbo\Repositories\Enrollment\EnrollmentRepositoryInterface;
use SigeTurbo\Repositories\Family\FamilyRepositoryInterface;
use SigeTurbo\Repositories\Payment\PaymentRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use SigeTurbo\Repositories\Preregistration\PreregistrationRepositoryInterface;
use SigeTurbo\Repositories\Responsibleparent\ResponsibleparentRepositoryInterface;
use SigeTurbo\Repositories\Transaction\TransactionRepositoryInterface;
use SigeTurbo\Repositories\Userfamily\UserfamilyRepositoryInterface;
use SigeTurbo\Repositories\Voucherconsecutive\VoucherconsecutiveRepositoryInterface;
use SigeTurbo\Repositories\Year\YearRepositoryInterface;
use SigeTurbo\Statusschooltype;
use SigeTurbo\Transactiontype;
use SigeTurbo\Vouchercategory;


class PaymentsController extends Controller
{
    /**
     * @var PaymentRepositoryInterface
     */
    private $paymentRepository;
    /**
     * @var FamilyRepositoryInterface
     */
    private $familyRepository;
    /**
     * @var YearRepositoryInterface
     */
    private $yearRepository;
    /**
     * @var UserfamilyRepositoryInterface
     */
    private $userfamilyRepository;
    /**
     * @var MailerInterface
     */
    private $mailer;
    /**
     * @var EnrollmentRepositoryInterface
     */
    private $enrollmentRepository;
    /**
     * @var CostRepositoryInterface
     */
    private $costRepository;
    /**
     * @var ResponsibleparentRepositoryInterface
     */
    private $responsibleparentRepository;
    /**
     * @var VoucherconsecutiveRepositoryInterface
     */
    private $voucherconsecutiveRepository;
    /**
     * @var TransactionRepositoryInterface
     */
    private $transactionRepository;
    /**
     * @var PreregistrationRepositoryInterface
     */
    private $preregistrationRepository;


    /**
     * @param PaymentRepositoryInterface $paymentRepository
     * @param FamilyRepositoryInterface $familyRepository
     * @param UserfamilyRepositoryInterface $userfamilyRepository
     * @param YearRepositoryInterface $yearRepository
     * @param MailerInterface $mailer
     * @param EnrollmentRepositoryInterface $enrollmentRepository
     * @param CostRepositoryInterface $costRepository
     * @param TransactionRepositoryInterface $transactionRepository
     * @param ResponsibleparentRepositoryInterface $responsibleparentRepository
     * @param VoucherconsecutiveRepositoryInterface $voucherconsecutiveRepository
     * @param PreregistrationRepositoryInterface $preregistrationRepository
     * @internal param YearRepositoryInterface $yearRepository
     */
    function __construct(PaymentRepositoryInterface $paymentRepository,
                         FamilyRepositoryInterface $familyRepository,
                         UserfamilyRepositoryInterface $userfamilyRepository,
                         YearRepositoryInterface $yearRepository,
                         MailerInterface $mailer,
                         EnrollmentRepositoryInterface $enrollmentRepository,
                         CostRepositoryInterface $costRepository,
                         TransactionRepositoryInterface $transactionRepository,
                         ResponsibleparentRepositoryInterface $responsibleparentRepository,
                         VoucherconsecutiveRepositoryInterface $voucherconsecutiveRepository,
                         PreregistrationRepositoryInterface $preregistrationRepository)
    {

        $this->paymentRepository = $paymentRepository;
        $this->familyRepository = $familyRepository;
        $this->yearRepository = $yearRepository;
        $this->userfamilyRepository = $userfamilyRepository;
        $this->mailer = $mailer;
        $this->enrollmentRepository = $enrollmentRepository;
        $this->costRepository = $costRepository;
        $this->transactionRepository = $transactionRepository;
        $this->responsibleparentRepository = $responsibleparentRepository;
        $this->voucherconsecutiveRepository = $voucherconsecutiveRepository;
        $this->preregistrationRepository = $preregistrationRepository;
    }

    /**
     * Display a listing of the resource.
     * GET /payments
     * @return Response
     */
    public function index()
    {
        return view('payments.index')
            ->withServerdate(Carbon::now()->format("Y-m-d"));
    }

    /**
     * Display a listing of the resource.
     * GET /payments
     * @return Response
     */
    public function receipts()
    {
        return view('payments.receipts')
            ->withServerdate(Carbon::now()->format("Y-m-d"));
    }

    /**
     * Payments Guest
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function guest()
    {
        return view('payments.guest');
    }

    /**
     * Edit Payment By ID
     * @param $payment
     * @param Request $request
     * @return mixed
     */
    public function edit($payment, Request $request)
    {
        return view('payments.edit')
            ->withPayment($this->paymentRepository->find($payment))
            ->withSort($request['sort'])
            ->withOrder($request['order'])
            ->withPage($request['page']);
    }


    /**
     * Update the specified resource in storage.
     * @param  int i$idpayment
     * @param PaymentRequest $request
     * @return Response
     */
    public function update($idpayment, PaymentRequest $request)
    {
        //Update Payment
        $payment = $this->paymentRepository->update($idpayment, $request);

        $data = [];
        if ($payment) {
            $data['successful'] = true;
            $data['message'] = Lang::get('sige.SuccessUpdateMessage');
            //Delete Cache
            Cache::forget('payments');
        } else {
            $data['unsuccessful'] = true;
            $data['message'] = Lang::get('sige.ErrorUpdateMessage');
        }
        return response()->json($data);
    }

    /**
     * Display the specified resource.
     * GET /payments/{idpayment}
     * @param  int $idpayment
     * @return Response
     */
    public function show($idpayment)
    {
        return response()->json($this->paymentRepository->find($idpayment));
    }

    /**
     * Create Payments For Families
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('payments.create');
    }


    /**
     * Update the specified resource in storage.
     * @param PaymentShortRequest $request
     * @return Response
     * @throws \Exception
     */
    public function updatePaymentShort(PaymentShortRequest $request)
    {

        //Generate Receipt
        DB::beginTransaction();
        try {
            //Update Payment
            $payment = $this->paymentRepository->updatePaymentShort($request);
            //Find Payment
            if ($payment) {
                $payment = $this->paymentRepository->find($request["payment"]);
                //Receipt
                $receipt = 'cash_receipt';
                $vouchertype = 2;
                if ($payment->idbank == 1) {
                    $receipt = 'virtual_receipt';
                    $vouchertype = 1;
                }
                $this->_generateReceipt($payment, $this->_getAccounts($payment->idbank), $receipt, $vouchertype);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }

        $data = [];
        if ($payment) {
            $data['successful'] = true;
            $data['message'] = Lang::get('sige.SuccessUpdateMessage');
            //Delete Cache
            Cache::forget('payments');
        } else {
            $data['unsuccessful'] = true;
            $data['message'] = Lang::get('sige.ErrorUpdateMessage');
        }
        return response()->json($data);
    }


    public function getPayments(Request $request)
    {
        return response()->json($this->paymentRepository->getPayments($request));
    }


    /**
     * Get Payments By User
     * @param Request $request
     * @return mixed
     */
    public function getPaymentsByUser(Request $request)
    {
        $pending = false;
        if (isset($request["pending"]) && $request["pending"] == "true") {
            $pending = true;
        }
        return response()->json($this->paymentRepository->getPaymentsByUser($request["user"], $pending));
    }

    /**
     * Get Payments Pending
     * @return mixed
     */
    public function getPaymentsPending()
    {
        return response()->json($this->paymentRepository->getPaymentsPending());
    }

    /**
     * Get Payments Pending By User
     * @return mixed
     */
    public function getPaymentsPendingByUser(Request $request)
    {
        return response()->json($this->paymentRepository->getPaymentsPendingByUser($request['user'], true, null, 'ASC', true));
    }

    /**
     * Get Payments By User With Transactions
     * @param $student
     * @return mixed
     */
    public function getPaymentsByUserWithTransactions($student)
    {
        return response()->json($this->paymentRepository->getPaymentsByUserWithTransactions($student));
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function getPaymentsByFamily(Request $request)
    {
        //Sort
        $sort = 'realdate';
        if (isset($request['sort'])) {
            $sort = $request['sort'];
        }

        //Order
        $order = 'desc';
        if (isset($request['order'])) {
            $order = $request['order'];
        }

        //Page
        if (!isset($request['page'])) {
            $request['page'] = 1;
        }

        $page = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 10;
        $payments = $this->paymentRepository->getPaymentsByUser(getUser()->iduser, false, $sort, strtoupper($order));
        $paginator = new LengthAwarePaginator(
            $payments->forPage($page, $perPage), $payments->count(), $perPage, $page
        );
        $paginator->setPath('parents/payments');
        return view('payments.paymentsbyfamily')
            ->withPayments($paginator)
            ->withSort($sort)
            ->withOrder($order);

    }

    /**
     * Checkout Payments
     * @param $payment
     * @return
     */
    public function checkout($payment)
    {
        return view('payments.checkout')
            ->withPayment($this->paymentRepository->getPaymentByID($payment))
            ->withTransaction(generateTransactionID());
    }

    /**
     * Get Detail Payment by Parents
     * @param $payment
     * @return mixed
     */
    public function detailPaymentByParent($payment)
    {
        return view('payments.detailbyparents')
            ->withPayment($this->paymentRepository->getPaymentByID($payment));
    }

    /**
     * Set Payments Method
     * @param Request $request
     * @return mixed
     */
    public function setPaymentMethod(Request $request)
    {
        //Save Payment Method
        $payment = $this->paymentRepository->setPaymentMethod($request);

        $data = [];
        if ($payment) {
            $data['successful'] = true;
            $data['message'] = Lang::get('sige.SuccessSaveMessage');
            $data['payment'] = $payment;
        } else {
            $data['unsuccessful'] = true;
            $data['message'] = Lang::get('sige.ErrorSaveMessage');
        }
        return response()->json($data);
    }

    /**
     * Set Payments Agreement
     * @param Request $request
     * @return mixed
     */
    public function setPaymentAgreement(Request $request)
    {
        //Save Payment Agreement
        $payment = $this->paymentRepository->setPaymentAgreement($request);

        $data = [];
        if ($payment) {
            $data['successful'] = true;
            $data['message'] = Lang::get('sige.SuccessSaveMessage');
            $data['payment'] = $payment;
        } else {
            $data['unsuccessful'] = true;
            $data['message'] = Lang::get('sige.ErrorSaveMessage');
        }
        return response()->json($data);
    }

    /**
     * Set Payment Massive
     * @param PaymentMassiveRequest $request
     * @return mixed
     * @throws \Exception
     */
    public function setPaymentMassive(PaymentMassiveRequest $request)
    {

        //DB::beginTransaction();
        //try {
        //Find Students
        $student_exclude = explode(",", $request["exclude"]);
        if ($request["type"] == 1) {
            //Find Student
            $count = 0;
            foreach ($this->enrollmentRepository->getEnrollments($request["academic"], null, [Category::STUDENT], Statusschooltype::STATUS_PREENROLLMENT, [], null, 'ASC', $student_exclude) as $student) {
                //Generate Payment
                //Find Costs
                $cost = $this->costRepository->costByGroup($request["academic"], $student->idgroup);
                //Find Family
                $family = $this->userfamilyRepository->getFamilyByUser($student->iduser);
                //Save Payment Individual
                $payment = $this->paymentRepository->setPaymentIndividual($family->family, $this->paymentRepository->configDataPayment($request["academic"], $student->idgroup, $cost, $student, $request));
                if ($payment) {
                    //Send Emails to Parents
                    $users = $this->userfamilyRepository->getFamilies(null, [$family->family], [Category::FATHER, Category::MOTHER]);
                    $this->mailer->byUsers('payment_created', $users, $payment);
                    $count++;
                }
            }
        } else {
            //Find Student
            $count = 0;
            foreach ($this->enrollmentRepository->getEnrollments($request["academic"], null, [Category::STUDENT], Statusschooltype::STATUS_ACTIVE, [], null, 'ASC', $student_exclude) as $student) {
                //Find Costs
                $cost = $this->costRepository->costByGroup($request["academic"], $student->idgroup);
                //Find Family
                $family = $this->userfamilyRepository->getFamilyByUser($student->iduser);
                //Put data
                $data = $request;
                $data["student"] = $student->iduser;
                $data["value1"] = ($student->scholarship > 0.00) ? (($cost->pension_normal) - ($cost->pension_normal * $student->scholarship)) : $cost->pension_discount;
                $data["value2"] = ($student->scholarship > 0.00) ? (($cost->pension_normal) - ($cost->pension_normal * $student->scholarship)) : $cost->pension_normal;
                $data["value3"] = ($student->scholarship > 0.00) ? ((($cost->pension_normal) - ($cost->pension_normal * $student->scholarship)) * 1.03) : $cost->pension_expired;
                $data["value4"] = ($student->scholarship > 0.00) ? (($cost->pension_normal) - ($cost->pension_normal * $student->scholarship)) : $cost->pension_normal;
                $data["firstname"] = $student->firstname;
                $data["lastname"] = $student->lastname;
                $data["gender"] = $student->gender;
                $data["scholarship"] = $student->scholarship;

                //Save Payment Individual
                $payment = $this->paymentRepository->setPaymentIndividual($family->family, $data);
                if ($payment) {
                    //Send Emails to Parents
                    //TO-DO
                    /*$users = $this->userfamilyRepository->getFamilies([$family->family], [Category::FATHER, Category::MOTHER]);
                    if ($users) {
                        $this->mailer->byUsers('payment_created', $users, $payment);
                    }*/
                    $count++;
                }

            }
        }
        //DB::commit();
        return response()->json(["successful" => true, 'message' => Lang::get('sige.SuccessPaymentsCreated'), 'count' => $count]);

        /*} catch (\Exception $e) {
            DB::rollback();
            return response()->json(["successful" => false], 300);
            throw $e;
        }*/

    }

    /**
     * Set Payment Individual
     * @param PaymentIndividualRequest $request
     * @return mixed
     */
    public function setPaymentIndividual(PaymentIndividualRequest $request)
    {
        //Find Family
        $family = $this->userfamilyRepository->getFamilyByUser($request['student']);
        //Save Payment Individual
        $payment = $this->paymentRepository->setPaymentIndividual($family->family, $request);

        $data = [];
        if ($payment) {
            $data['successful'] = true;
            $data['message'] = Lang::get('sige.SuccessSaveMessage');
            $data['payment'] = $payment;
            //Send Emails to Parents
            $users = $this->userfamilyRepository->getFamilies(null, [$family->family], [Category::FATHER, Category::MOTHER]);
            $this->mailer->byUsers('payment_created', $users, $payment);
        } else {
            $data['unsuccessful'] = true;
            $data['message'] = Lang::get('sige.ErrorSaveMessage');
        }
        return response()->json($data);
    }

    /**
     * Set Payment Individual NEW
     * @param PaymentIndividualRequest $request
     * @return mixed
     */
    public function setPaymentIndividualNew(PaymentIndividualRequest $request)
    {

        DB::beginTransaction();
        try {
            //Find Family
            $family = $this->userfamilyRepository->getFamilyByUser($request['student']);
            //Save Payment Individual
            $payment = $this->paymentRepository->setPaymentIndividual($family->family, $request);
            /*if ($payment) {
                //Generate Invoice
                $this->_generateInvoice($payment);
            }*/
            DB::commit();
            //Update Consecutive
            return response()->json(["successful" => true, 'message' => Lang::get('sige.SuccessPaymentCreated'), 'payment' => $payment]);

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(["successful" => false], 300);
            throw $e;
        }
    }

    /**
     * Generate Payment Individual By User
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function setPaymentIndividualByUser(Request $request)
    {

        //Preregistration Year
        $year = $this->yearRepository->getCurrentPreregistration();
        if (isset($year->idyear)) {

            //Get Latest Enrollment With Grade
            $enrollment = $this->enrollmentRepository->getEnrollmentsLatestByStudent($request['user'], $year->idyear);

            //Costs
            $costs = $this->costRepository->getCostsByPackageAndCategory($year->idyear, $enrollment->idgrade, Concepttype::ENROLLMENT, Package::PACKAGE_1105, Vouchercategory::INVOICE);
            //Find Family
            $family = $this->userfamilyRepository->getFamilyByUser($request['user']);
            //Set Total Cost
            $cost = [];
            $cost["value1"] = costTotal($costs, 'normal', Transactiontype::DEBIT) - costTotal($costs, 'discount', Transactiontype::DEBIT);
            $cost["value2"] = costTotal($costs, 'normal', Transactiontype::DEBIT);
            $cost["value3"] = costTotal($costs, 'normal', Transactiontype::DEBIT) + costTotal($costs, 'expired', Transactiontype::CREDIT);
            $cost["value4"] = costTotal($costs, 'normal', Transactiontype::DEBIT);

            //Generate Payment
            $payment = $this->paymentRepository->setPaymentIndividual($family->family, $this->paymentRepository->configDataPayment($year->idyear, $enrollment->idgroup, $cost, $enrollment));
            if (isset($payment)) {
                //Set Payment Created
                $this->preregistrationRepository->setPaymentCreated($enrollment->iduser);
            }
            //Respond
            return response()->json(["successful" => true, 'message' => Lang::get('sige.SuccessPaymentCreated'), 'payment' => $payment]);

        } else {
            return response()->json(["successful" => false, 'message' => 'Not Year'], 300);
        }


    }

    /**
     * Payment Convert
     * @param Request $request
     * @return mixed
     */
    public function paymentsConvert(Request $request)
    {

        //Search Payments
        //Testing
        $payments = $this->paymentRepository->getPaymentsByYearAndMonth($request["year"], $request["month"]);
        foreach ($payments as $payment) {
            //Generate Invoice
            $this->_generateInvoiceExtended($payment);
        }

        /*DB::beginTransaction();
        try {
            //Search Payments
            $payments = $this->paymentRepository->getPaymentsByYearAndMonth($request["year"], $request["month"]);
            foreach ($payments as $payment) {
                //Generate Invoice
                $this->_generateInvoice($payment);
            }
            DB::commit();
            return "OK";
        } catch (\Exception $e) {
            DB::rollback();
            return "Bad";
            throw $e;
        }*/

    }


    /**
     * Payment Convert Virtual Receipt
     * @param Request $request
     * @return mixed
     */
    public function paymentsConvertVirtualReceipt(Request $request)
    {
        DB::beginTransaction();
        try {
            //Search Virtual Receipt
            $payments = $this->paymentRepository->getPaymentsApprovedByYearANDMonth($request["year"], $request["month"]);

            foreach ($payments as $payment) {
                //Generate Receipt
                $this->_generateReceipt($payment);
            }
            DB::commit();
            return "OK";
        } catch (\Exception $e) {
            DB::rollback();
            return "Bad";
            throw $e;
        }

    }


    /**
     * Payment Convert Manual Receipt
     * @param Request $request
     * @return mixed
     */
    public function paymentsConvertManualReceipt(Request $request)
    {

        DB::beginTransaction();
        try {
            //Search Virtual Receipt
            $payments = $this->paymentRepository->getPaymentsVirtualApprovedByYearANDMonth($request["year"], $request["month"]);
            foreach ($payments as $payment) {
                //Generate Receipt
                $this->_generateReceipt($payment);
            }
            DB::commit();
            return "OK";
        } catch (\Exception $e) {
            DB::rollback();
            return "Bad";
            throw $e;
        }

    }

    /**
     * Respond Payment
     * @param PaymentRespondRequest $request
     * @return mixed
     * @throws \Exception
     */
    public function respond(PaymentRespondRequest $request)
    {


        //Get Payment By TransactionID
        $payment = $this->paymentRepository->getPaymentByTransactionID($request['transaccionConvenioId']);

        //Verified Payment By CPV
        $client = new Client();
        $body['convenioId'] = 4300;
        $body['transaccionConvenioId'] = $payment->transaccionTNS;
        $body['hash'] = $payment->hash;

        $response = $client->post('https://www.pagosvirtualesavvillas.com.co/personal/pagos/consultar/', [
            'body' => json_encode($body),
            'headers' => [
                'Accept' => 'application/json',
                "Content-type" => "application/json; charset=utf-8"
            ]
        ]);
        $paymentCPV = json_decode($response->getBody(), true);

        if ($payment->ispayment == 'N') {
            if ($this->paymentRepository->setPaymentStatus($payment->idpayment, $request, $paymentCPV)) {
                //Find Payment
                $payment = $this->paymentRepository->find($payment->idpayment);
                //Verify Payment Approved
                if ($paymentCPV['aprobado'] == 'A') {
                    //Generate Receipt
                    DB::beginTransaction();
                    try {
                        $this->_generateReceipt($payment);
                        DB::commit();
                    } catch (\Exception $e) {
                        DB::rollback();
                        throw $e;
                    }
                }
                //Send Email
                $this->mailer->byRoles('payment_accepted', $payment, ['Admin', 'Treasurer', 'Account']);
                //Return view
                return view('payments.respond')
                    ->withPayment($this->paymentRepository->find($payment->idpayment));
            } else {
                return view('payments.respond')
                    ->withPayment($payment)
                    ->withStatus(['payment' => false]);
            }
        } else {
            return view('payments.respond')
                ->withPayment($payment)
                ->withStatus(['payment' => true]);
        }
    }

    /**
     * Verify Payment Pending
     * @param Request $request
     * @return mixed
     * @throws \Exception
     */
    public function verifyPaymentPending(Request $request)
    {
        //Get Payment By ID
        $payment = $this->paymentRepository->find($request['payment']);

        //Verified Payment By CPV
        $client = new Client();
        $body['convenioId'] = 4300;
        $body['transaccionConvenioId'] = $payment->transaccionTNS;
        $body['hash'] = $payment->hash;

        $response = $client->post('https://www.pagosvirtualesavvillas.com.co/personal/pagos/consultar/', [
            'body' => json_encode($body),
            'headers' => [
                'Accept' => 'application/json',
                "Content-type" => "application/json; charset=utf-8"
            ]
        ]);

        //Bank Response
        $paymentCPV = json_decode($response->getBody(), true);

        //Verify Payment
        $data = [];
        if ($payment->ispayment == 'N' && $paymentCPV["aprobado"] == "A") {

            if ($this->paymentRepository->verifyPaymentPending($payment->idpayment, $paymentCPV)) {
                //Generate Receipt
                if ($paymentCPV["aprobado"] == "A") {
                    //Generate Receipt
                    DB::beginTransaction();
                    try {
                        $this->_generateReceipt($payment);
                        DB::commit();
                    } catch (\Exception $e) {
                        DB::rollback();
                        throw $e;
                    }
                }
                //Send Email
                $payment = $this->paymentRepository->find($payment->idpayment);
                $this->mailer->byRoles('payment_accepted', $payment, ['Account', 'Treasurer', 'Admin']);
                //Return json
                $data['successful'] = true;
                $data['message'] = Lang::get('sige.SuccessSaveMessage');
                $data['payment'] = $payment;
                return response()->json($data);

            } else {
                $data['successful'] = false;
                $data['message'] = Lang::get('sige.ErrorSaveMessage');
                $data['payment'] = $paymentCPV;
                return response()->json($data, 300);
            }

        } else if ($paymentCPV["aprobado"] == "A") {

            $data['successful'] = false;
            $data['message'] = ($paymentCPV["aprobado"] == "A") ? "El pago fue tramitado virtual" : "El pago fue tramitado manual";
            $data['payment'] = $paymentCPV;
            return response()->json($data, 200);

        } else if ($paymentCPV["aprobado"] == "R" || $paymentCPV["aprobado"] == null) {

            DB::beginTransaction();
            try {
                $this->paymentRepository->updatePaymentRejected(['payment' => $payment->idpayment]);
                DB::commit();
            } catch (\Exception $e) {
                DB::rollback();
                throw $e;
            }

            $data['successful'] = false;
            $data['message'] = "El pago fue rechazado o sin transacción";
            $data['payment'] = $paymentCPV;
            return response()->json($data, 200);

        } else if ($paymentCPV["aprobado"] == "P") {

            $data['successful'] = false;
            $data['message'] = "El pago continúa en estado PENDIENTE";
            $data['payment'] = $paymentCPV;
            return response()->json($data, 200);
        }

    }

    /**
     * Generate Invoice
     * @param $payment
     */
    private function _generateInvoice($payment)
    {
        ///Document
        $document = $this->voucherconsecutiveRepository->getCurrentDocumentByType('invoice');

        //Find Student
        $student = $this->enrollmentRepository->getEnrollmentsLatestByStudent($payment->iduser);
        $lastname = explode(" ", $student->lastname);
        $firstname = explode(" ", $student->firstname);

        //Responsible
        $responsible = $this->responsibleparentRepository->getResponsibleByStudent($payment->iduser);

        if ($payment->idpaymenttype == 2) {

            //Save Debit Transaction
            $debit = [
                'payment' => $payment->idpayment,
                'user' => $payment->iduser,
                'vouchertype' => 3,
                'accounttype' => 5,
                'transactiontype' => 1,
                'costcenter' => $this->_costCenter($student->idgroup),
                'value' => $payment->value2,
                'base' => 0,
                'description' => "P" . setZero(2, Carbon::parse($payment->realdate)->format('m')) . " " . mb_strtoupper($lastname[0]) . " " . mb_strtoupper($firstname[0]),
                'document' => $document->consecutive,
                'reference' => 0,
                'transaction' => '',
                'term' => '0',
                'nit' => $responsible->responsible,
                'date' => $payment->created_at,
                'realdate' => $payment->realdate,
            ];
            $this->transactionRepository->store($debit);

            //Save Credit Transaction
            $credit = [
                'payment' => $payment->idpayment,
                'user' => $payment->iduser,
                'vouchertype' => 3,
                'accounttype' => 6,
                'transactiontype' => 2,
                'costcenter' => $this->_costCenter($student->idgroup),
                'value' => $payment->value2,
                'base' => 0,
                'description' => "P" . setZero(2, Carbon::parse($payment->realdate)->format('m')) . " " . mb_strtoupper($lastname[0]) . " " . mb_strtoupper($firstname[0]),
                'document' => $document->consecutive,
                'reference' => 0,
                'transaction' => '',
                'term' => '0',
                'nit' => $responsible->responsible,
                'date' => $payment->created_at,
                'realdate' => $payment->realdate,
            ];
            $this->transactionRepository->store($credit);

        } elseif ($payment->idpaymenttype == 1) {

            //Save Debit Transaction
            $debit = [
                'payment' => $payment->idpayment,
                'user' => $payment->iduser,
                'vouchertype' => 3,
                'accounttype' => 7,
                'transactiontype' => 1,
                'costcenter' => $this->_costCenter($student->idgroup),
                'value' => $payment->value2,
                'base' => 0,
                'description' => mb_strtoupper($lastname[0]) . " " . mb_strtoupper($firstname[0]),
                'document' => $document->consecutive,
                'reference' => 0,
                'transaction' => '',
                'term' => '0',
                'nit' => $responsible->responsible,
                'date' => $payment->created_at,
                'realdate' => $payment->realdate,
            ];
            $this->transactionRepository->store($debit);

            //Save Credit Transaction
            $credit = [
                'payment' => $payment->idpayment,
                'user' => $payment->iduser,
                'vouchertype' => 3,
                'accounttype' => 8,
                'transactiontype' => 2,
                'costcenter' => $this->_costCenter($student->idgroup),
                'value' => $payment->value2,
                'base' => 0,
                'description' => mb_strtoupper($lastname[0]) . " " . mb_strtoupper($firstname[0]),
                'document' => $document->consecutive,
                'reference' => 0,
                'transaction' => '',
                'term' => '0',
                'nit' => $responsible->responsible,
                'date' => $payment->created_at,
                'realdate' => $payment->realdate,
            ];
            $this->transactionRepository->store($credit);

        }
        //Update Consecutive Document
        $this->voucherconsecutiveRepository->updateDocumentByID($document->idvoucherconsecutive);
    }

    /**
     * Generate Invoice
     * @param $payment
     */
    private
    function _generateInvoiceExtended($payment)
    {
        //Document
        $document = $this->voucherconsecutiveRepository->getCurrentDocumentByType('invoice');

        //Find Student
        $student = $this->enrollmentRepository->getEnrollmentsLatestByStudent($payment->iduser);
        $lastname = explode(" ", $student->lastname);
        $firstname = explode(" ", $student->firstname);
        //Responsible
        $responsible = $this->responsibleparentRepository->getResponsibleByStudent($payment->iduser);

        if ($payment->idpaymenttype == 2) {
            //Save Debit Transaction
            $debit = [
                'payment' => $payment->idpayment,
                'user' => $payment->iduser,
                'vouchertype' => 3,
                'accounttype' => 5,
                'transactiontype' => 1,
                'costcenter' => $this->_costCenter($student->idgroup),
                'value' => $payment->value2,
                'base' => 0,
                'description' => "P" . setZero(2, Carbon::parse($payment->realdate)->format('m')) . " " . mb_strtoupper($lastname[0]) . " " . mb_strtoupper($firstname[0]),
                'document' => $document->consecutive,
                'reference' => 0,
                'transaction' => '',
                'term' => '0',
                'nit' => $responsible->responsible,
                'date' => $payment->created_at,
                'realdate' => $payment->realdate,
            ];
            $this->transactionRepository->store($debit);

            //Save Credit Transaction
            $credit = [
                'payment' => $payment->idpayment,
                'user' => $payment->iduser,
                'vouchertype' => 3,
                'accounttype' => 6,
                'transactiontype' => 2,
                'costcenter' => $this->_costCenter($student->idgroup),
                'value' => $payment->value2,
                'base' => 0,
                'description' => "P" . setZero(2, Carbon::parse($payment->realdate)->format('m')) . " " . mb_strtoupper($lastname[0]) . " " . mb_strtoupper($firstname[0]),
                'document' => $document->consecutive,
                'reference' => 0,
                'transaction' => '',
                'term' => '0',
                'nit' => $responsible->responsible,
                'date' => $payment->created_at,
                'realdate' => $payment->realdate,
            ];
            $this->transactionRepository->store($credit);

        } elseif ($payment->idpaymenttype == 1) {

            $isNewStudent = $this->_likematch($this->yearRepository->getCurrentYear()->idyear . '%', $payment->iduser);
            if ($isNewStudent) {
                //Save Student card
                $transactionNew = [
                    'payment' => $payment->idpayment,
                    'user' => $payment->iduser,
                    'vouchertype' => 3,
                    'accounttype' => 15,
                    'transactiontype' => 2,
                    'costcenter' => $this->_costCenter($student->idgroup),
                    'value' => 10000,
                    'base' => 0,
                    'description' => "CARNÉ ESTUDIANTIL",
                    'document' => $document->consecutive,
                    'reference' => 0,
                    'transaction' => '',
                    'term' => '0',
                    'nit' => $responsible->responsible,
                    'date' => $payment->created_at,
                    'realdate' => $payment->realdate,
                ];
                $this->transactionRepository->store($transactionNew);
            }

            for ($i = 1; $i <= 6; $i++) {
                $transactionnew = [
                    'payment' => $payment->idpayment,
                    'user' => $payment->iduser,
                    'vouchertype' => 3,
                    'costcenter' => $this->_costCenter($student->idgroup),
                    'base' => 0,
                    'document' => $document->consecutive,
                    'reference' => 0,
                    'transaction' => '',
                    'term' => '0',
                    'nit' => $responsible->responsible,
                    'date' => $payment->created_at,
                    'realdate' => $payment->realdate,
                ];

                //$this->transactionRepository->store($debit);

                switch ($payment->value2) {
                    case 1358000://Parvulos y Prejardin
                        switch ($i) {
                            case 1:
                                $transactionnew["description"] = mb_strtoupper($lastname[0]) . " " . mb_strtoupper($firstname[0]);
                                $transactionnew['accounttype'] = 8;
                                $transactionnew['value'] = 900000;
                                $transactionnew['transactiontype'] = 2;
                                $this->transactionRepository->store($transactionnew);
                                break;
                            case 2:
                                $transactionnew["description"] = "GUÍA DE TRABAJO";
                                $transactionnew['accounttype'] = 11;
                                $transactionnew['value'] = 252000;
                                $transactionnew['transactiontype'] = 2;
                                $this->transactionRepository->store($transactionnew);
                                break;
                            case 3:
                                $transactionnew["description"] = "SALIDAS PEDAGÓGICAS";
                                $transactionnew['accounttype'] = 12;
                                $transactionnew['value'] = 127000;
                                $transactionnew['transactiontype'] = 2;
                                $this->transactionRepository->store($transactionnew);
                                break;
                            case 4:
                                $transactionnew["description"] = "LUDOTECA";
                                $transactionnew['accounttype'] = 13;
                                $transactionnew['value'] = 79000;
                                $transactionnew['transactiontype'] = 2;
                                $this->transactionRepository->store($transactionnew);
                                break;
                            case 5:
                                $transactionnew["description"] = mb_strtoupper($lastname[0]) . " " . mb_strtoupper($firstname[0]);
                                $transactionnew['accounttype'] = 7;
                                $transactionnew['value'] = 900000;
                                $transactionnew['transactiontype'] = 1;
                                $this->transactionRepository->store($transactionnew);
                                break;
                            case 6:
                                $transactionnew["description"] = "OTROS COSTOS";
                                $transactionnew['accounttype'] = 16;
                                $transactionnew['value'] = ($isNewStudent) ? 468000 : 458000;
                                $transactionnew['transactiontype'] = 1;
                                $this->transactionRepository->store($transactionnew);
                                break;
                        }
                        break;
                    case 1389000: //
                        //Jardin y Transicion
                        switch ($i) {
                            case 1:
                                $transactionnew["description"] = mb_strtoupper($lastname[0]) . " " . mb_strtoupper($firstname[0]);
                                $transactionnew['accounttype'] = 8;
                                $transactionnew['value'] = 931000;
                                $transactionnew['transactiontype'] = 2;
                                $this->transactionRepository->store($transactionnew);
                                break;
                            case 2:
                                $transactionnew["description"] = "GUÍA DE TRABAJO";
                                $transactionnew['accounttype'] = 11;
                                $transactionnew['value'] = 252000;
                                $transactionnew['transactiontype'] = 2;
                                $this->transactionRepository->store($transactionnew);
                                break;
                            case 3:
                                $transactionnew["description"] = "SALIDAS PEDAGÓGICAS";
                                $transactionnew['accounttype'] = 12;
                                $transactionnew['value'] = 127000;
                                $transactionnew['transactiontype'] = 2;
                                $this->transactionRepository->store($transactionnew);
                                break;
                            case 4:
                                $transactionnew["description"] = "LUDOTECA";
                                $transactionnew['accounttype'] = 13;
                                $transactionnew['value'] = 79000;
                                $transactionnew['transactiontype'] = 2;
                                $this->transactionRepository->store($transactionnew);
                                break;
                            case 5:
                                $transactionnew["description"] = mb_strtoupper($lastname[0]) . " " . mb_strtoupper($firstname[0]);
                                $transactionnew['accounttype'] = 7;
                                $transactionnew['value'] = 931000;
                                $transactionnew['transactiontype'] = 1;
                                $this->transactionRepository->store($transactionnew);
                                break;
                            case 6:
                                $transactionnew["description"] = "OTROS COSTOS";
                                $transactionnew['accounttype'] = 16;
                                $transactionnew['value'] = ($isNewStudent) ? 468000 : 458000;
                                $transactionnew['transactiontype'] = 1;
                                $this->transactionRepository->store($transactionnew);
                                break;
                        }
                        break;
                    case 1469000:
                        //Primero a Quinto
                        switch ($i) {
                            case 1:
                                $transactionnew["description"] = mb_strtoupper($lastname[0]) . " " . mb_strtoupper($firstname[0]);
                                $transactionnew['accounttype'] = 8;
                                $transactionnew['value'] = 1090000;
                                $transactionnew['transactiontype'] = 2;
                                $this->transactionRepository->store($transactionnew);
                                break;
                            case 2:
                                $transactionnew["description"] = "GUÍA DE TRABAJO";
                                $transactionnew['accounttype'] = 11;
                                $transactionnew['value'] = 252000;
                                $transactionnew['transactiontype'] = 2;
                                $this->transactionRepository->store($transactionnew);
                                break;
                            case 3:
                                $transactionnew["description"] = "SALIDAS PEDAGÓGICAS";
                                $transactionnew['accounttype'] = 12;
                                $transactionnew['value'] = 127000;
                                $transactionnew['transactiontype'] = 2;
                                $this->transactionRepository->store($transactionnew);
                                break;
                            case 4:

                                break;
                            case 5:
                                $transactionnew["description"] = mb_strtoupper($lastname[0]) . " " . mb_strtoupper($firstname[0]);
                                $transactionnew['accounttype'] = 7;
                                $transactionnew['value'] = 1090000;
                                $transactionnew['transactiontype'] = 1;
                                $this->transactionRepository->store($transactionnew);
                                break;
                            case 6:
                                $transactionnew["description"] = "OTROS COSTOS";
                                $transactionnew['accounttype'] = 16;
                                $transactionnew['value'] = ($isNewStudent) ? 389000 : 379000;
                                $transactionnew['transactiontype'] = 1;
                                $this->transactionRepository->store($transactionnew);
                                break;
                        }
                        break;
                    case 1550000:
                        //Sexto a Octavo
                        switch ($i) {
                            case 1:
                                $transactionnew["description"] = mb_strtoupper($lastname[0]) . " " . mb_strtoupper($firstname[0]);
                                $transactionnew['accounttype'] = 8;
                                $transactionnew['value'] = 1117000;
                                $transactionnew['transactiontype'] = 2;
                                $this->transactionRepository->store($transactionnew);
                                break;
                            case 2:
                                $transactionnew["description"] = "GUÍA DE TRABAJO";
                                $transactionnew['accounttype'] = 11;
                                $transactionnew['value'] = 306000;
                                $transactionnew['transactiontype'] = 2;
                                $this->transactionRepository->store($transactionnew);
                                break;
                            case 3:
                                $transactionnew["description"] = "SALIDAS PEDAGÓGICAS";
                                $transactionnew['accounttype'] = 12;
                                $transactionnew['value'] = 127000;
                                $transactionnew['transactiontype'] = 2;
                                $this->transactionRepository->store($transactionnew);
                                break;
                            case 4:

                                break;
                            case 5:
                                $transactionnew["description"] = mb_strtoupper($lastname[0]) . " " . mb_strtoupper($firstname[0]);
                                $transactionnew['accounttype'] = 7;
                                $transactionnew['value'] = 1117000;
                                $transactionnew['transactiontype'] = 1;
                                $this->transactionRepository->store($transactionnew);
                                break;
                            case 6:
                                $transactionnew["description"] = "OTROS COSTOS";
                                $transactionnew['accounttype'] = 16;
                                $transactionnew['value'] = ($isNewStudent) ? 443000 : 433000;
                                $transactionnew['transactiontype'] = 1;
                                $this->transactionRepository->store($transactionnew);
                                break;
                        }
                        break;
                    case 1560000:
                        //Noveno
                        switch ($i) {
                            case 1:
                                $transactionnew["description"] = mb_strtoupper($lastname[0]) . " " . mb_strtoupper($firstname[0]);
                                $transactionnew['accounttype'] = 8;
                                $transactionnew['value'] = 1117000;
                                $transactionnew['transactiontype'] = 2;
                                $this->transactionRepository->store($transactionnew);
                                break;
                            case 2:
                                $transactionnew["description"] = "GUÍA DE TRABAJO";
                                $transactionnew['accounttype'] = 11;
                                $transactionnew['value'] = 306000;
                                $transactionnew['transactiontype'] = 2;
                                $this->transactionRepository->store($transactionnew);
                                break;
                            case 3:
                                $transactionnew["description"] = "SALIDAS PEDAGÓGICAS";
                                $transactionnew['accounttype'] = 12;
                                $transactionnew['value'] = 127000;
                                $transactionnew['transactiontype'] = 2;
                                $this->transactionRepository->store($transactionnew);
                                break;
                            case 4:
                                $transactionnew["description"] = "DERECHOS DE GRADO";
                                $transactionnew['accounttype'] = 14;
                                $transactionnew['value'] = 10000;
                                $transactionnew['transactiontype'] = 2;
                                $this->transactionRepository->store($transactionnew);
                                break;
                            case 5:
                                $transactionnew["description"] = mb_strtoupper($lastname[0]) . " " . mb_strtoupper($firstname[0]);
                                $transactionnew['accounttype'] = 7;
                                $transactionnew['value'] = 1117000;
                                $transactionnew['transactiontype'] = 1;
                                $this->transactionRepository->store($transactionnew);
                                break;
                            case 6:
                                $transactionnew["description"] = "OTROS COSTOS";
                                $transactionnew['accounttype'] = 16;
                                $transactionnew['value'] = ($isNewStudent) ? 453000 : 443000;
                                $transactionnew['transactiontype'] = 1;
                                $this->transactionRepository->store($transactionnew);
                                break;
                        }
                        break;
                    case 1615000:
                        //Décimo
                        switch ($i) {
                            case 1:
                                $transactionnew["description"] = mb_strtoupper($lastname[0]) . " " . mb_strtoupper($firstname[0]);
                                $transactionnew['accounttype'] = 8;
                                $transactionnew['value'] = 1140000;
                                $transactionnew['transactiontype'] = 2;
                                $this->transactionRepository->store($transactionnew);
                                break;
                            case 2:
                                $transactionnew["description"] = "GUÍA DE TRABAJO";
                                $transactionnew['accounttype'] = 11;
                                $transactionnew['value'] = 348000;
                                $transactionnew['transactiontype'] = 2;
                                $this->transactionRepository->store($transactionnew);
                                break;
                            case 3:
                                $transactionnew["description"] = "SALIDAS PEDAGÓGICAS";
                                $transactionnew['accounttype'] = 12;
                                $transactionnew['value'] = 127000;
                                $transactionnew['transactiontype'] = 2;
                                $this->transactionRepository->store($transactionnew);
                                break;
                            case 4:

                                break;
                            case 5:
                                $transactionnew["description"] = mb_strtoupper($lastname[0]) . " " . mb_strtoupper($firstname[0]);
                                $transactionnew['accounttype'] = 7;
                                $transactionnew['value'] = 1140000;
                                $transactionnew['transactiontype'] = 1;
                                $this->transactionRepository->store($transactionnew);
                                break;
                            case 6:
                                $transactionnew["description"] = "OTROS COSTOS";
                                $transactionnew['accounttype'] = 16;
                                $transactionnew['value'] = ($isNewStudent) ? 485000 : 475000;
                                $transactionnew['transactiontype'] = 1;
                                $this->transactionRepository->store($transactionnew);
                                break;
                        }
                        break;
                    case 1861000:
                        //Undécimo
                        switch ($i) {
                            case 1:
                                $transactionnew["description"] = mb_strtoupper($lastname[0]) . " " . mb_strtoupper($firstname[0]);
                                $transactionnew['accounttype'] = 8;
                                $transactionnew['value'] = 1140000;
                                $transactionnew['transactiontype'] = 2;
                                $this->transactionRepository->store($transactionnew);
                                break;
                            case 2:
                                $transactionnew["description"] = "GUÍA DE TRABAJO";
                                $transactionnew['accounttype'] = 11;
                                $transactionnew['value'] = 348000;
                                $transactionnew['transactiontype'] = 2;
                                $this->transactionRepository->store($transactionnew);
                                break;
                            case 3:
                                $transactionnew["description"] = "SALIDAS PEDAGÓGICAS";
                                $transactionnew['accounttype'] = 12;
                                $transactionnew['value'] = 127000;
                                $transactionnew['transactiontype'] = 2;
                                $this->transactionRepository->store($transactionnew);
                                break;
                            case 4:
                                $transactionnew["description"] = "DERECHOS DE GRADO";
                                $transactionnew['accounttype'] = 14;
                                $transactionnew['value'] = 246000;
                                $transactionnew['transactiontype'] = 2;
                                $this->transactionRepository->store($transactionnew);
                                break;
                            case 5:
                                $transactionnew["description"] = mb_strtoupper($lastname[0]) . " " . mb_strtoupper($firstname[0]);
                                $transactionnew['accounttype'] = 7;
                                $transactionnew['value'] = 1140000;
                                $transactionnew['transactiontype'] = 1;
                                $this->transactionRepository->store($transactionnew);
                                break;
                            case 6:
                                $transactionnew["description"] = "OTROS COSTOS";
                                $transactionnew['accounttype'] = 16;
                                $transactionnew['value'] = ($isNewStudent) ? 731000 : 721000;
                                $transactionnew['transactiontype'] = 1;
                                $this->transactionRepository->store($transactionnew);
                                break;
                        }
                        break;
                } //End swicht
            }//End For
        } //Endif
        //Update Consecutive Document
        $this->voucherconsecutiveRepository->updateDocumentByID($document->idvoucherconsecutive);

    }

    /**
     * Generate Virtual Receipt
     * @param $payment
     * @param array $account
     * @param string $type
     */
    private function _generateReceipt($payment, $account = [Accounttype::ACCOUNT_BCO_AVVILLAS, Accounttype::ACCOUNT_PENSIONES, Accounttype::ACCOUNT_BCO_AVVILLAS, Accounttype::ACCOUNT_MATRICULA], $type = 'virtual_receipt', $vouchertype = 1)
    {
        ///Document
        $document = $this->voucherconsecutiveRepository->getCurrentDocumentByType($type);

        //Find Student
        $student = $this->enrollmentRepository->getEnrollmentsLatestByStudent($payment->iduser);
        $lastname = explode(" ", $student->lastname);
        $firstname = explode(" ", $student->firstname);

        //Responsible
        $responsible = $this->responsibleparentRepository->getResponsibleByStudent($payment->iduser);

        if ($payment->idpaymenttype == 2) {

            //Save Debit Transaction
            $debit = [
                'payment' => $payment->idpayment,
                'user' => $payment->iduser,
                'vouchertype' => $vouchertype,
                'accounttype' => $account[0],
                'transactiontype' => 1,
                'costcenter' => $this->_costCenter($student->idgroup),
                'value' => $payment->realValue,
                'base' => 0,
                'description' => "P" . setZero(2, Carbon::parse($payment->realdate)->format('m')) . " " . mb_strtoupper($lastname[0]) . " " . mb_strtoupper($firstname[0]),
                'document' => $document->consecutive,
                'reference' => 0,
                'transaction' => '',
                'term' => '0',
                'nit' => $responsible->responsible,
                'date' => $payment->payment_at,
                'realdate' => $payment->realdate,
            ];
            $this->transactionRepository->store($debit);


            //Save Credit Transaction
            $credit = [
                'payment' => $payment->idpayment,
                'user' => $payment->iduser,
                'vouchertype' => $vouchertype,
                'accounttype' => $account[1],
                'transactiontype' => 2,
                'costcenter' => $this->_costCenter($student->idgroup),
                'value' => $payment->value2,
                'base' => 0,
                'description' => "P" . setZero(2, Carbon::parse($payment->realdate)->format('m')) . " " . mb_strtoupper($lastname[0]) . " " . mb_strtoupper($firstname[0]),
                'document' => $document->consecutive,
                'reference' => 0,
                'transaction' => '',
                'term' => '0',
                'nit' => $responsible->responsible,
                'date' => $payment->payment_at,
                'realdate' => $payment->realdate,
            ];
            $this->transactionRepository->store($credit);

        } elseif ($payment->idpaymenttype == 1) {

            //Save Debit Transaction
            $debit = [
                'payment' => $payment->idpayment,
                'user' => $payment->iduser,
                'vouchertype' => $vouchertype,
                'accounttype' => $account[2],
                'transactiontype' => 1,
                'costcenter' => $this->_costCenter($student->idgroup),
                'value' => $payment->realValue,
                'base' => 0,
                'description' => mb_strtoupper($lastname[0]) . " " . mb_strtoupper($firstname[0]),
                'document' => $document->consecutive,
                'reference' => 0,
                'transaction' => '',
                'term' => '0',
                'nit' => $responsible->responsible,
                'date' => $payment->payment_at,
                'realdate' => $payment->realdate,
            ];
            $this->transactionRepository->store($debit);

            //Save Credit Transaction
            for ($i = 1; $i <= 2; $i++) {
                $transactionnew = [
                    'payment' => $payment->idpayment,
                    'user' => $payment->iduser,
                    'vouchertype' => $vouchertype,
                    'costcenter' => $this->_costCenter($student->idgroup),
                    'transactiontype' => 2,
                    'base' => 0,
                    'document' => $document->consecutive,
                    'reference' => 0,
                    'transaction' => '',
                    'term' => '0',
                    'nit' => $responsible->responsible,
                    'date' => $payment->payment_at,
                    'realdate' => $payment->realdate,
                ];

                //$this->transactionRepository->store($debit);

                switch ($payment->value2) {
                    case 1358000://Parvulos y Prejardin
                        switch ($i) {
                            case 1:
                                $transactionnew["description"] = "MATRÍCULA";
                                $transactionnew['accounttype'] = 7;
                                $transactionnew['value'] = 900000;
                                $this->transactionRepository->store($transactionnew);
                                break;
                            case 2:
                                $transactionnew["description"] = "OTROS COSTOS";
                                $transactionnew['accounttype'] = 16;
                                $transactionnew['value'] = 458000;
                                $this->transactionRepository->store($transactionnew);
                                break;
                        }
                        break;
                    case 1389000: //
                        //Jardin y Transicion
                        switch ($i) {
                            case 1:
                                $transactionnew["description"] = "MATRÍCULA";
                                $transactionnew['accounttype'] = 7;
                                $transactionnew['value'] = 931000;
                                $this->transactionRepository->store($transactionnew);
                                break;
                            case 2:
                                $transactionnew["description"] = "OTROS COSTOS";
                                $transactionnew['accounttype'] = 16;
                                $transactionnew['value'] = 458000;
                                $this->transactionRepository->store($transactionnew);
                                break;
                        }
                        break;
                    case 1469000:
                        //Primero a Quinto
                        switch ($i) {
                            case 1:
                                $transactionnew["description"] = "MATRÍCULA";
                                $transactionnew['accounttype'] = 7;
                                $transactionnew['value'] = 1090000;
                                $this->transactionRepository->store($transactionnew);
                                break;
                            case 2:
                                $transactionnew["description"] = "OTROS COSTOS";
                                $transactionnew['accounttype'] = 16;
                                $transactionnew['value'] = 379000;
                                $this->transactionRepository->store($transactionnew);
                                break;
                        }
                        break;
                    case 1550000:
                        //Sexto a Octavo
                        switch ($i) {
                            case 1:
                                $transactionnew["description"] = "MATRÍCULA";
                                $transactionnew['accounttype'] = 7;
                                $transactionnew['value'] = 1117000;
                                $this->transactionRepository->store($transactionnew);
                                break;
                            case 2:
                                $transactionnew["description"] = "OTROS COSTOS";
                                $transactionnew['accounttype'] = 16;
                                $transactionnew['value'] = 433000;
                                $this->transactionRepository->store($transactionnew);
                                break;
                        }
                        break;
                    case 1560000:
                        //Noveno
                        switch ($i) {
                            case 1:
                                $transactionnew["description"] = "MATRÍCULA";
                                $transactionnew['accounttype'] = 7;
                                $transactionnew['value'] = 1117000;
                                $this->transactionRepository->store($transactionnew);
                                break;
                            case 2:
                                $transactionnew["description"] = "OTROS COSTOS";
                                $transactionnew['accounttype'] = 16;
                                $transactionnew['value'] = 443000;
                                $this->transactionRepository->store($transactionnew);
                                break;
                        }
                        break;
                    case 1615000:
                        //Décimo
                        switch ($i) {
                            case 1:
                                $transactionnew["description"] = "MATRÍCULA";
                                $transactionnew['accounttype'] = 7;
                                $transactionnew['value'] = 1140000;
                                $this->transactionRepository->store($transactionnew);
                                break;
                            case 2:
                                $transactionnew["description"] = "OTROS COSTOS";
                                $transactionnew['accounttype'] = 16;
                                $transactionnew['value'] = 475000;
                                $this->transactionRepository->store($transactionnew);
                                break;
                        }
                        break;
                    case 1861000:
                        //Undécimo
                        switch ($i) {
                            case 1:
                                $transactionnew["description"] = "MATRÍCULA";
                                $transactionnew['accounttype'] = 7;
                                $transactionnew['value'] = 1140000;
                                $this->transactionRepository->store($transactionnew);
                                break;
                            case 2:
                                $transactionnew["description"] = "OTROS COSTOS";
                                $transactionnew['accounttype'] = 16;
                                $transactionnew['value'] = 721000;
                                $this->transactionRepository->store($transactionnew);
                                break;
                        }
                        break;
                } //EndSwitch
            } //EndFor
        }
        if ($payment->value2 < $payment->realValue) {
            //Save Credit Transaction
            $credit = [
                'payment' => $payment->idpayment,
                'user' => $payment->iduser,
                'vouchertype' => $vouchertype,
                'accounttype' => Accounttype::ACCOUNT_INTERESES,
                'transactiontype' => 2,
                'costcenter' => $this->_costCenter($student->idgroup),
                'value' => $payment->realValue - $payment->value2,
                'base' => 0,
                'description' => 'INTERESES',
                'document' => $document->consecutive,
                'reference' => 0,
                'transaction' => '',
                'term' => '0',
                'nit' => $responsible->responsible,
                'date' => $payment->payment_at,
                'realdate' => $payment->realdate,
            ];
            $this->transactionRepository->store($credit);
        }


        if ($payment->value2 > $payment->realValue) {
            //Save Debit Transaction
            $credit = [
                'payment' => $payment->idpayment,
                'user' => $payment->iduser,
                'vouchertype' => $vouchertype,
                'accounttype' => Accounttype::ACCOUNT_DCTOS,
                'transactiontype' => 1,
                'costcenter' => costCenter($student->idgroup),
                'value' => $payment->value2 - $payment->realValue,
                'base' => 0,
                'description' => 'DESCUENTO',
                'document' => $document->consecutive,
                'reference' => 0,
                'transaction' => '',
                'term' => '0',
                'nit' => $responsible->responsible,
                'date' => $payment->payment_at,
                'realdate' => $payment->realdate,
            ];
            $this->transactionRepository->store($credit);
        }


        //Update Consecutive Document
        $this->voucherconsecutiveRepository->updateDocumentByID($document->idvoucherconsecutive);
    }

    /**
     * SQL Like operator in PHP.
     * Returns TRUE if match else FALSE.
     * @param string $pattern
     * @param string $subject
     * @return bool
     */
    private
    function _likematch($pattern, $subject)
    {
        $pattern = str_replace('%', '.*', preg_quote($pattern, '/'));
        return (bool)preg_match("/^{$pattern}$/i", $subject);
    }


    /**
     * Config Accounts By Bank
     * @param $bank
     * @return array
     */
    private
    function _getAccounts($bank)
    {
        switch ($bank) {
            case 1:
                return [Accounttype::ACCOUNT_BCO_AVVILLAS, Accounttype::ACCOUNT_PENSIONES, Accounttype::ACCOUNT_BCO_AVVILLAS, Accounttype::ACCOUNT_MATRICULA];
                break;
            case 2:
                return [Accounttype::ACCOUNT_CASH_GENERAL, Accounttype::ACCOUNT_PENSIONES, Accounttype::ACCOUNT_CASH_GENERAL, Accounttype::ACCOUNT_MATRICULA];
                break;
            case 3:
                return [Accounttype::ACCOUNT_BCO_AVVILLAS, Accounttype::ACCOUNT_PENSIONES, Accounttype::ACCOUNT_BCO_AVVILLAS, Accounttype::ACCOUNT_MATRICULA];
                break;
            case 4:
                return [Accounttype::ACCOUNT_BCO_BBVA_CTE, Accounttype::ACCOUNT_PENSIONES, Accounttype::ACCOUNT_BCO_BBVA_CTE, Accounttype::ACCOUNT_MATRICULA];
                break;
            case 5:
                return [Accounttype::ACCOUNT_BCO_BBVA_AHO, Accounttype::ACCOUNT_PENSIONES, Accounttype::ACCOUNT_BCO_BBVA_AHO, Accounttype::ACCOUNT_MATRICULA];
                break;
        }
    }
}