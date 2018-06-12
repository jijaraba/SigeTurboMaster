<?php

namespace SigeTurbo\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Lang;
use SigeTurbo\Http\Requests\ReceiptRequest;
use SigeTurbo\Repositories\Payment\PaymentRepositoryInterface;
use SigeTurbo\Repositories\Receipt\ReceiptRepositoryInterface;
use SigeTurbo\Repositories\Receiptpayment\ReceiptpaymentRepositoryInterface;

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
     * ReceiptsController constructor.
     * @param ReceiptRepositoryInterface $receiptRepository
     * @param PaymentRepositoryInterface $paymentRepository
     * @param ReceiptpaymentRepositoryInterface $receiptpaymentRepository
     */
    public function __construct(ReceiptRepositoryInterface $receiptRepository,
                                PaymentRepositoryInterface $paymentRepository,
                                ReceiptpaymentRepositoryInterface $receiptpaymentRepository)
    {
        $this->receiptRepository = $receiptRepository;
        $this->paymentRepository = $paymentRepository;
        $this->receiptpaymentRepository = $receiptpaymentRepository;
    }

    /**
     * Store a newly created resource in storage.
     * @param ReceiptRequest $request
     * @return Response
     */
    public function store(ReceiptRequest $request)
    {

        //Save Receipt
        $receipt = $this->receiptRepository->store($request);

        $data = [];
        if ($receipt) {

            //Update Payments
            foreach ($request['payments'] as $payment) {
                //Update Payment
                $paymentData = [
                    'payment' => $payment['payment'],
                    'bank' => $request['bank'],
                    'voucher' => $request['consecutive'],
                    'value' => $payment['value'],
                    'method' => $payment['method'],
                    'observation' => $request['description'],
                    'transaction' => $request['consecutive'],
                    'date' => $request['date'],
                ];
                if ($this->paymentRepository->updatePaymentShort($paymentData)) {
                    //Create Receipt Payment
                    $receiptData = [
                        'receipt' => $receipt->idreceipt,
                        'payment' => $payment['payment'],
                        'value' => $payment['value'],
                    ];
                    if ($this->receiptpaymentRepository->store($receiptData)) {

                    }
                }
            }


            $data['successful'] = true;
            $data['message'] = Lang::get('sige.SuccessSaveMessage');
            $data['receipt'] = $receipt;
            //Delete Cache
            Cache::forget('receipts');
        } else {
            $data['unsuccessful'] = true;
            $data['message'] = Lang::get('sige.ErrorSaveMessage');
        }
        return response()->json($data);
    }
}
