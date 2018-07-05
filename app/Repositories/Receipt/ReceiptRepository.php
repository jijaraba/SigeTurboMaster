<?php

namespace SigeTurbo\Repositories\Receipt;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use SigeTurbo\Receipt;
use SigeTurbo\Vouchertype;

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
            'value' => stringToCurrency($data['value']),
            'description' => $data['description'],
            'created_by' => getUser()->iduser,
            'created_at' => Carbon::now(),
        ]);
    }

    /**
     * Get All Receipts By Vouchertype
     * @param $vouchertype
     * @param $document
     * @return mixed
     */
    public function getReceiptsByVouchertype($vouchertype, $document)
    {
        $receipt = Receipt::select('receipts.*', 'vouchertypes.name AS vouchertype', 'users.iduser', 'users.photo', DB::raw('CONCAT_WS(CONVERT(" " USING latin1),users.lastname,users.firstname) AS fullname'))
            ->join('vouchertypes', function ($join) {
                $join
                    ->on('vouchertypes.idvouchertype', '=', 'receipts.idvouchertype');
            })
            ->join('users', function ($join) {
                $join
                    ->on('users.iduser', '=', 'receipts.created_by');
            })
            ->where('receipts.idvouchertype', '=', $vouchertype);

        //Find Document
        if ($document <> 'all') {
            if (count(explode(',', $document)) > 1) {
                $documents = explode(',', $document);
                $first = true;
                foreach ($documents as $doc) {
                    if (count(explode('-', $doc)) > 1) {
                        $docs = explode('-', $doc);
                        $receipt
                            ->whereRaw('document BETWEEN ' . $docs[0] . ' AND ' . $docs[1] . '');
                    } else {
                        if ($first) {
                            $receipt
                                ->where('document', '=', $doc);
                            $first = false;
                        } else {
                            $receipt
                                ->orWhere('document', '=', $doc);
                        }

                    }
                }
            } else if (count(explode('-', $document)) > 1) {
                $documents = explode('-', $document);
                $receipt
                    ->whereRaw('document BETWEEN ' . $documents[0] . ' AND ' . $documents[1] . '');
            } else {
                $receipt
                    ->where('document', '=', $document);
            }
        }

        return $receipt
            ->orderBy('receipts.document', 'DESC')
            ->with('receiptpayments')
            ->get();
    }
}