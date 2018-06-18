<?php

namespace SigeTurbo\Repositories\Accountingentry;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use SigeTurbo\Accountingentry;

class AccountingentryRepository implements AccountingentryRepositoryInterface
{

    /**
     * Get All Accounting Entries
     * @return mixed
     */
    public function all()
    {
        return Cache::remember('accountingentries', 1440, function () {
            return Accountingentry::select('accountingentries.*')
                ->get();
        });
    }

    /**
     * Find Accounting Entries By ID
     * @param $accountingentry
     * @return mixed
     */
    public function find($accountingentry)
    {
        return Accountingentry::find($accountingentry);
    }

    public function store($data)
    {
        return Accountingentry::create(array(
            'idreceipt' => $data['receipt'],
            'idaccounttype' => $data['accounttype'],
            'idtransactiontype' => $data['transactiontype'],
            'idcostcenter' => $data['costcenter'],
            'reference' => 0,
            'value' => $data['value'],
            'base' => 0,
            'transaction' => (!is_null($data['transaction']) ? $data['transaction'] : ''),
            'term' => 0,
            'nit' => (!is_null($data['nit']) ? $data['nit'] : 0),
            'description' => $data['description'],
            'date' => $data['date'],
            "created_by" => getUser()->iduser,
            'created_at' => Carbon::now(),
        ));
    }

    public function update($accountingentry, $data)
    {
        //Find Transaction
        $accountingentry = Accountingentry::find($accountingentry);
        $accountingentry->fill([
            'idreceipt' => $data['receipt'],
            'idaccounttype' => $data['accounttype'],
            'idtransactiontype' => $data['transactiontype'],
            'idcostcenter' => $data['costcenter'],
            'reference' => 0,
            'value' => $data['value'],
            'base' => 0,
            'transaction' => (!is_null($data['transaction']) ? $data['transaction'] : ''),
            'term' => 0,
            'nit' => (!is_null($data['nit']) ? $data['nit'] : 0),
            'description' => $data['description'],
            'date' => $data['date'],
            "updated_by" => getUser()->iduser,
            'updated_at' => Carbon::now()
        ]);
        return $accountingentry->save();
    }

    public function destroy($accountingentry)
    {
        $accountingentry = Accountingentry::find($accountingentry);
        return $accountingentry->delete();

    }

    /**
     * Get Accountngentries By Receipt
     * @param $receipt
     * @return mixed
     */
    public function getAccountingentriesByReceipt($receipt)
    {
        return Accountingentry::select('accountingentries.*', 'vouchertypes.code AS vouchertype', 'accounttypes.code AS accounttype', 'costcenters.code AS costcenter', DB::raw("CONCAT_WS(CONVERT(' ' USING latin1),users.lastname,users.firstname) AS employee"), 'users.photo')
            ->join('users', function ($join) {
                $join
                    ->on('users.iduser', '=', 'accountingentries.created_by');
            })
            ->join('receipts', function ($join) {
                $join->on('receipts.idreceipt', '=', 'accountingentries.idreceipt');
            })
            ->join('vouchertypes', function ($join) {
                $join->on('vouchertypes.idvouchertype', '=', 'receipts.idvouchertype');
            })
            ->join('accounttypes', function ($join) {
                $join->on('accounttypes.idaccounttype', '=', 'accountingentries.idaccounttype');
            })
            ->join('costcenters', function ($join) {
                $join->on('costcenters.idcostcenter', '=', 'accountingentries.idcostcenter');
            })
            ->where('accountingentries.idreceipt', "=", $receipt)
            ->get();
    }


    /**
     * Get Accountingentry By Receipt And Accounttype
     * @param $receipt
     * @param $accounttype
     * @return mixed
     */
    public function getAccountingentriesByReceiptAndAccounttype($receipt, $accounttype)
    {
        return Accountingentry::select('*')
            ->where('idreceipt', '=', $receipt)
            ->where('idaccounttype', '=', $accounttype)
            ->first();
    }
}