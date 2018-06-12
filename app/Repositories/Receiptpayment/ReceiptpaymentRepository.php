<?php

namespace SigeTurbo\Repositories\Receiptpayment;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use SigeTurbo\Receiptpayment;

class ReceiptpaymentRepository implements ReceiptpaymentRepositoryInterface
{

    /**
     * Get All ReceiptPayment
     * @return mixed
     */
    public function all()
    {
        return Cache::remember('receiptpayments', 1440, function () {
            return Receiptpayment::all();
        });
    }

    /**
     * Find Receiptpayment By ID
     * @param $receiptpayment
     * @return mixed
     */
    public function find($receiptpayment)
    {
        return Receiptpayment::find($receiptpayment);
    }

    /**
     * Save Receiptpayment
     * @param $data
     * @return mixed
     */
    public function store($data)
    {
        return Receiptpayment::create([
            'idreceipt' => $data['receipt'],
            'idpayment' => $data['payment'],
            'value' => $data['value'],
            'created_by' => getUser()->iduser,
            'created_at' => Carbon::now(),
        ]);
    }
}