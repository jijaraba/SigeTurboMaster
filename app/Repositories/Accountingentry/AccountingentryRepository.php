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

    /**
     * Get Transaction To Export
     * @return mixed
     */
    public function getTransactionsToExport($code, $dateinit, $datefinish)
    {
        $select = Transaction::select(DB::raw("CONCAT(RPAD(accounttypes.code,10,' '),LPAD(vouchertypes.code,5,'0'),LPAD(DATE_FORMAT(transactions.date,'%m/%d/%Y'),10,'0'),LPAD(transactions.document,9,'0'),LPAD(transactions.reference,9,'0'),LPAD(transactions.nit,11,' '),RPAD(stringReplace(transactions.description,'ÁÉÍÓÚÑ','AEIOUN'),28,' '),transactiontypes.prefix,LPAD(transactions.value,21,' '),LPAD(transactions.base,21,' '),RPAD(costcenters.code,6,' '),LPAD(transactions.transaction,3,' '),LPAD(transactions.term,4,' ')) AS Asiento"))
            //return Transaction::select(DB::raw("CONCAT(RPAD(accounttypes.code,10,' '),LPAD(vouchertypes.code,5,'0'),LPAD(DATE_FORMAT(transactions.realdate,'%m/%d/%Y'),10,'0'),LPAD(transactions.document,9,'0'),LPAD(transactions.reference,9,'0'),LPAD(transactions.nit,11,' '),RPAD(stringReplace(transactions.description,'ÁÉÍÓÚÑ','AEIOUN'),28,' '),transactiontypes.prefix,LPAD(transactions.value,21,' '),LPAD(transactions.base,21,' '),RPAD(costcenters.code,6,' '),LPAD(transactions.transaction,3,' '),LPAD(transactions.term,4,' ')) AS Asiento"))
            ->join('accounttypes', function ($join) {
                $join
                    ->on('accounttypes.idaccounttype', '=', 'transactions.idaccounttype');
            })
            ->join('vouchertypes', function ($join) {
                $join
                    ->on('vouchertypes.idvouchertype', '=', 'transactions.idvouchertype');
            })
            ->join('transactiontypes', function ($join) {
                $join
                    ->on('transactiontypes.idtransactiontype', '=', 'transactions.idtransactiontype');
            })
            ->join('costcenters', function ($join) {
                $join
                    ->on('costcenters.idcostcenter', '=', 'transactions.idcostcenter');
            })
            ->whereIn('vouchertypes.code', [$code])
            ->whereBetween('transactions.date', array($dateinit, $datefinish))
            ->orderBy('vouchertypes.code', 'ASC')
            ->orderBy('transactions.date', 'ASC')
            ->orderBy('transactions.idpayment', 'ASC')
            ->orderBy('accounttypes.order');
        return
            $select->get();
    }

    /**
     * Get AccountingEntries To Export
     * @param $code
     * @param $date_from
     * @param $date_to
     * @return mixed
     */
    public function getAccountingentriesToExport($code, $date_from, $date_to)
    {
        $select = Accountingentry::select(DB::raw("CONCAT(RPAD(accounttypes.code,10,' '),LPAD(vouchertypes.code,5,'0'),LPAD(DATE_FORMAT(receipts.date,'%m/%d/%Y'),10,'0'),LPAD(receipts.document,9,'0'),LPAD(accountingentries.reference,9,'0'),LPAD(accountingentries.nit,11,' '),RPAD(stringReplace(accountingentries.description,'ÁÉÍÓÚÑÀÈÌÒÙ','AEIOUNAEIOU'),28,' '),transactiontypes.prefix,LPAD(accountingentries.value,21,' '),LPAD(accountingentries.base,21,' '),RPAD(costcenters.code,6,' '),LPAD(accountingentries.transaction,3,' '),LPAD(accountingentries.term,4,' ')) AS Asiento"))
            ->join('receipts', function ($join) {
                $join
                    ->on('receipts.idreceipt', '=', 'accountingentries.idreceipt');
            })
            ->join('accounttypes', function ($join) {
                $join
                    ->on('accounttypes.idaccounttype', '=', 'accountingentries.idaccounttype');
            })
            ->join('vouchertypes', function ($join) {
                $join
                    ->on('vouchertypes.idvouchertype', '=', 'receipts.idvouchertype');
            })
            ->join('transactiontypes', function ($join) {
                $join
                    ->on('transactiontypes.idtransactiontype', '=', 'accountingentries.idtransactiontype');
            })
            ->join('costcenters', function ($join) {
                $join
                    ->on('costcenters.idcostcenter', '=', 'accountingentries.idcostcenter');
            })
            ->whereIn('vouchertypes.code', [$code])
            ->whereBetween('accountingentries.date', array($date_from, $date_to))
            ->orderBy('vouchertypes.code', 'ASC')
            ->orderBy('receipts.document', 'ASC')
            ->orderBy('accounttypes.order');
        return
            $select->get();
    }
}