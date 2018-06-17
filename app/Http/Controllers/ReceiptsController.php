<?php

namespace SigeTurbo\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use SigeTurbo\Accounttype;
use SigeTurbo\Http\Requests\ReceiptRequest;
use SigeTurbo\Repositories\Accountingentry\AccountingentryRepositoryInterface;
use SigeTurbo\Repositories\Accountingentry\AccountingentryRespository;
use SigeTurbo\Repositories\Accounttype\AccounttypeRepositoryInterface;
use SigeTurbo\Repositories\Bank\BankRepositoryInterface;
use SigeTurbo\Repositories\Cost\CostRepositoryInterface;
use SigeTurbo\Repositories\Enrollment\EnrollmentRepositoryInterface;
use SigeTurbo\Repositories\Group\GroupRepositoryInterface;
use SigeTurbo\Repositories\Payment\PaymentRepositoryInterface;
use SigeTurbo\Repositories\Receipt\ReceiptRepositoryInterface;
use SigeTurbo\Repositories\Receiptpayment\ReceiptpaymentRepositoryInterface;
use SigeTurbo\Repositories\Responsibleparent\ResponsibleparentRepositoryInterface;
use SigeTurbo\Repositories\Userfamily\UserfamilyRepositoryInterface;
use SigeTurbo\Repositories\Voucherconsecutive\VoucherconsecutiveRepositoryInterface;
use SigeTurbo\Repositories\Year\YearRepositoryInterface;
use SigeTurbo\Transactiontype;
use SigeTurbo\Vouchercategory;

class ReceiptsController extends Controller
{
    /**
     * @var ReceiptRepositoryInterface
     */
    private $receiptRepository;
    /**
     * @var PaymentRepositoryInterface
     */
    private $paymentRepository;
    /**
     * @var ReceiptpaymentRepositoryInterface
     */
    private $receiptpaymentRepository;
    /**
     * @var VoucherconsecutiveRepositoryInterface
     */
    private $voucherconsecutiveRepository;
    /**
     * @var EnrollmentRepositoryInterface
     */
    private $enrollmentRepository;
    /**
     * @var ResponsibleparentRepositoryInterface
     */
    private $responsibleparentRepository;
    /**
     * @var BankRepositoryInterface
     */
    private $bankRepository;
    /**
     * @var AccountingentryRepositoryInterface
     */
    private $accountingentryRepository;
    /**
     * @var UserfamilyRepositoryInterface
     */
    private $userfamilyRepository;
    /**
     * @var AccounttypeRepositoryInterface
     */
    private $accounttypeRepository;
    /**
     * @var CostRepositoryInterface
     */
    private $costRepository;
    /**
     * @var YearRepositoryInterface
     */
    private $yearRepository;
    /**
     * @var GroupRepositoryInterface
     */
    private $groupRepository;

    /**
     * ReceiptsController constructor.
     * @param ReceiptRepositoryInterface $receiptRepository
     * @param PaymentRepositoryInterface $paymentRepository
     * @param ReceiptpaymentRepositoryInterface $receiptpaymentRepository
     * @param VoucherconsecutiveRepositoryInterface $voucherconsecutiveRepository
     * @param EnrollmentRepositoryInterface $enrollmentRepository
     * @param ResponsibleparentRepositoryInterface $responsibleparentRepository
     * @param BankRepositoryInterface $bankRepository
     * @param AccountingentryRepositoryInterface $accountingentryRepository
     * @param UserfamilyRepositoryInterface $userfamilyRepository
     * @param AccounttypeRepositoryInterface $accounttypeRepository
     * @param CostRepositoryInterface $costRepository
     * @param YearRepositoryInterface $yearRepository
     * @param GroupRepositoryInterface $groupRepository
     */
    public function __construct(ReceiptRepositoryInterface $receiptRepository,
                                PaymentRepositoryInterface $paymentRepository,
                                ReceiptpaymentRepositoryInterface $receiptpaymentRepository,
                                VoucherconsecutiveRepositoryInterface $voucherconsecutiveRepository,
                                EnrollmentRepositoryInterface $enrollmentRepository,
                                ResponsibleparentRepositoryInterface $responsibleparentRepository,
                                BankRepositoryInterface $bankRepository,
                                AccountingentryRepositoryInterface $accountingentryRepository,
                                UserfamilyRepositoryInterface $userfamilyRepository,
                                AccounttypeRepositoryInterface $accounttypeRepository,
                                CostRepositoryInterface $costRepository,
                                YearRepositoryInterface $yearRepository,
                                GroupRepositoryInterface $groupRepository)
    {
        $this->receiptRepository = $receiptRepository;
        $this->paymentRepository = $paymentRepository;
        $this->receiptpaymentRepository = $receiptpaymentRepository;
        $this->voucherconsecutiveRepository = $voucherconsecutiveRepository;
        $this->enrollmentRepository = $enrollmentRepository;
        $this->responsibleparentRepository = $responsibleparentRepository;
        $this->bankRepository = $bankRepository;
        $this->accountingentryRepository = $accountingentryRepository;
        $this->userfamilyRepository = $userfamilyRepository;
        $this->accounttypeRepository = $accounttypeRepository;
        $this->costRepository = $costRepository;
        $this->yearRepository = $yearRepository;
        $this->groupRepository = $groupRepository;
    }

    /**
     * Store a newly created resource in storage.
     * @param ReceiptRequest $request
     * @return Response
     */
    public function store(ReceiptRequest $request)
    {
        //DB::beginTransaction();
        //try {
        ///Document
        $document = $this->voucherconsecutiveRepository->getCurrentDocumentByVoucher($request['voucher']);
        if (isset($document->consecutive)) {
            $request['consecutive'] = $document->consecutive;
        }//Save Receipt
        $receipt = $this->receiptRepository->store($request);
        $data = [];
        if ($receipt) {

            //First Entry
            $first = true;

            //Update Payments
            foreach ($request['payments'] as $payment) {

                $receiptValue = 0;
                $ispayment = 'N';
                $approved = 'N';

                //Current Payment
                $paymentCurrent = $this->paymentRepository->getPaymentByID($payment['payment']);
                if ($paymentCurrent) {
                    if ($paymentCurrent->ispayment === 'N') {
                        $ispayment = ((float)$payment['real_value'] == (float)$payment['receipt_value']) ? 'Y' : 'P';
                        $approved = ((float)$payment['real_value'] == (float)$payment['receipt_value']) ? 'A' : 'N';
                        $receiptValue = $payment['receipt_value'];
                    } elseif ($paymentCurrent->ispayment === 'P') {
                        $ispayment = ((float)$payment['real_value'] == ((float)$payment['receipt_value']) + (float)$paymentCurrent->receipt_value) ? 'Y' : 'P';
                        $approved = ((float)$payment['real_value'] == ((float)$payment['receipt_value']) + (float)$paymentCurrent->receipt_value) ? 'A' : 'N';
                        $receiptValue = $payment['receipt_value'] + $paymentCurrent->receipt_value;
                    }
                }

                //Update Payment
                $paymentData = [
                    'ispayment' => $ispayment,
                    'approved' => $approved,
                    'payment' => $payment['payment'],
                    'bank' => $request['bank'],
                    'voucher' => $request['consecutive'],
                    'real_value' => $payment['real_value'],
                    'receipt_value' => $receiptValue,
                    'method' => $payment['method'],
                    'observation' => $request['description'],
                    'transaction' => $request['consecutive'],
                    'date' => $request['date'],
                ];
                if ($this->paymentRepository->updatePaymentShort($paymentData)) {

                    //Get Current Payment
                    $paymentCurrent = $this->paymentRepository->getPaymentByID($payment['payment']);

                    //Find Student
                    $student = $this->enrollmentRepository->getEnrollmentsLatestByStudent($paymentCurrent->iduser, $paymentCurrent->idyear);

                    //Create Receipt Payment
                    $receiptData = [
                        'receipt' => $receipt->idreceipt,
                        'payment' => $payment['payment'],
                        'value' => $payment['receipt_value'],
                    ];
                    if ($this->receiptpaymentRepository->store($receiptData)) {
                        //Create Accountingentry By Bank
                        if ($first) {
                            //Bank
                            $accounttype = $this->accounttypeRepository->find($this->bankRepository->find($request['bank'])->idaccounttype);
                            $this->_generateAccountingEntryByPayments($receipt->idreceipt, $request['value'], $accounttype, Transactiontype::DEBIT, 1, $paymentCurrent->iduser, $request['date'], $paymentCurrent->realdate, false, $first);
                            $first = false;
                        }
                        /**
                         * Create Accountingentry By Payment
                         */
                        //Get Group By Student

                        $group = $this->groupRepository::getLatestGroupByStudent($paymentCurrent->iduser, $paymentCurrent->idyear);
                        $costs = $this->costRepository->getCostsByPackageAndCategory($paymentCurrent->idyear, $group->idgrade, $paymentCurrent->idpaymenttype, $paymentCurrent->idpackage, Vouchercategory::RECEIPT);
                        foreach ($costs as $cost) {
                            //Payment With Discount
                            if ($paymentCurrent->method == 'discount') {
                                if ($cost->idaccounttype != Accounttype::ACCOUNT_INTERESES) {
                                    if ($cost->idaccounttype == Accounttype::ACCOUNT_PENSIONES) {
                                        $this->_generateAccountingEntryByPayments($receipt->idreceipt, ($cost->value - ($cost->value * $student->scholarship)), $cost, $cost->idtransactiontype, \costCenter($group->idgroup), $paymentCurrent->iduser, $request['date'], $paymentCurrent->realdate, true, $first);
                                    } else {
                                        $this->_generateAccountingEntryByPayments($receipt->idreceipt, $cost->value, $cost, $cost->idtransactiontype, \costCenter($group->idgroup), $paymentCurrent->iduser, $request['date'], $paymentCurrent->realdate, true, $first);
                                    }
                                }
                            }
                            //Payment Normal
                            if ($paymentCurrent->method == 'normal') {
                                if ($cost->idaccounttype != Accounttype::ACCOUNT_INTERESES && $cost->idaccounttype != Accounttype::ACCOUNT_DCTOS) {
                                    if ($cost->idaccounttype == Accounttype::ACCOUNT_PENSIONES) {
                                        $this->_generateAccountingEntryByPayments($receipt->idreceipt, ($cost->value - ($cost->value * $student->scholarship)), $cost, $cost->idtransactiontype, \costCenter($group->idgroup), $paymentCurrent->iduser, $request['date'], $paymentCurrent->realdate, true, $first);
                                    } else {
                                        $this->_generateAccountingEntryByPayments($receipt->idreceipt, $cost->value, $cost, $cost->idtransactiontype, \costCenter($group->idgroup), $paymentCurrent->iduser, $request['date'], $paymentCurrent->realdate, true, $first);
                                    }
                                }
                            }
                            //Payment Expired
                            if ($paymentCurrent->method == 'expired') {
                                if ($cost->idaccounttype != Accounttype::ACCOUNT_DCTOS) {
                                    if ($cost->idaccounttype == Accounttype::ACCOUNT_PENSIONES) {
                                        $this->_generateAccountingEntryByPayments($receipt->idreceipt, ($cost->value - ($cost->value * $student->scholarship)), $cost, $cost->idtransactiontype, \costCenter($group->idgroup), $paymentCurrent->iduser, $request['date'], $paymentCurrent->realdate, true, $first);
                                    } else {
                                        $this->_generateAccountingEntryByPayments($receipt->idreceipt, $cost->value, $cost, $cost->idtransactiontype, \costCenter($group->idgroup), $paymentCurrent->iduser, $request['date'], $paymentCurrent->realdate, true, $first);
                                    }
                                }
                            }
                        }
                    }
                }
            }
            $data['successful'] = true;
            $data['message'] = Lang::get('sige.SuccessSaveMessage');
            $data['receipt'] = $receipt;
            //Delete Cache
            Cache::forget('receipts');
            Cache::forget('voucherconsecutives');
            Cache::forget('vouchertypes');
            //Update Consecutive Document
            $this->voucherconsecutiveRepository->updateDocumentByID($document->idvoucherconsecutive);
        } else {
            $data['unsuccessful'] = true;
            $data['message'] = Lang::get('sige.ErrorSaveMessage');
        }
        //DB::commit();
        return response()->json($data);
        //} catch (\Exception $e) {
        //   DB::rollback();
        //  return response()->json(["successful" => false], 300);
        //}
    }


    /**
     * Generate Accountingentries
     * @param $receipt | receipt
     * @param $value | Global value
     * @param $accounttype
     * @param $transactiontype
     * @param $costcenter
     * @param $user
     * @param $date
     * @param $realdate
     * @param $findResponsible
     * @param $first
     */
    private function _generateAccountingEntryByPayments($receipt, $value, $accounttype, $transactiontype, $costcenter, $user, $date, $realdate, $findResponsible, $first)
    {
        //Responsible
        $responsible = 0;
        if ($findResponsible) {
            $responsible = $this->responsibleparentRepository->getResponsibleByStudent($user);
        }

        //Save Debit And Credit Accountingentry
        $data = [
            'receipt' => $receipt,
            'accounttype' => $accounttype->idaccounttype,
            'transactiontype' => $transactiontype,
            'costcenter' => $costcenter,
            'reference' => 0,
            'value' => stringToCurrency($value),
            'base' => 0,
            'transaction' => '',
            'term' => '0',
            'nit' => (isset($responsible->responsible)) ? $responsible->responsible : $responsible,
            'description' => $this->_generateDescription($accounttype, $user, $realdate, $first),
            'date' => $date,
        ];
        $this->accountingentryRepository->store($data);
    }

    /**
     * Generate Description By Accountingentry
     * @param $accounttype
     * @param $user
     * @param $realdate
     * @param $first
     * @return string
     */
    private function _generateDescription($accounttype, $user, $realdate, $first)
    {
        if (Accounttype::ACCOUNT_PENSIONES == $accounttype->idaccounttype) {
            //Find Student
            $student = $this->enrollmentRepository->getEnrollmentsLatestByStudent($user);
            $lastname = explode(" ", $student->lastname);
            $firstname = explode(" ", $student->firstname);
            return "P" . setZero(2, Carbon::parse($realdate)->format('m')) . " " . mb_strtoupper($lastname[0]) . " " . mb_strtoupper($firstname[0]);
        } else if ($first) {
            //Find Family
            return mb_strtoupper(Lang::get('sige.Family') . " " . $this->userfamilyRepository->getFamilyName($user)->family);
        } else {
            return $accounttype->accounttype;
        }
    }


    /**
     * Get All Receipts
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getReceiptsByVouchertype(Request $request)
    {
        return response()->json($this->receiptRepository->getReceiptsByVouchertype($request['vouchertype']));
    }

}
