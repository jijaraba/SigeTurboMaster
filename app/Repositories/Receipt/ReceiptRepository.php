<?php

namespace SigeTurbo\Repositories\Receipt;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use SigeTurbo\Receipt;

class ReceiptRepository implements ReceiptRepositoryInterface
{

    /**
     * Get All Receipts
     * @return mixed
     */
    public function all()
    {
        return Cache::remember('receipts', 1440, function () {
            return Receipt::all();
        });
    }

    /**
     * Find Receipt By ID
     * @param $receipt
     * @return mixed
     */
    public function find($receipt)
    {
        return Receipt::find($receipt);
    }

    /**
     * Save Receipt
     * @param $data
     * @return mixed
     */
    public function store($data)
    {
        return Receipt::create([
            'idvouchertype' => $data['voucher'],
            'document' => $data['consecutive'],
            'date' => $data['date'],
            'realdate' => Carbon::now(),
            'value' => (float)(str_replace('$', '', str_replace(',', '', $data['value']))),
            'description' => $data['description'],
            'created_by' => getUser()->iduser,
            'created_at' => Carbon::now(),
        ]);
    }
}