<?php

namespace SigeTurbo\Repositories\Transaction;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use SigeTurbo\Transaction;

class TransactionRepository implements TransactionRepositoryInterface
{

    public function all()
    {
        return Cache::remember('transactions', 1440, function () {
            return Transaction::select('transactions.*')
                ->get();
        });
    }

    public function find($idtransaction)
    {
        return Transaction::find($idtransaction);
    }

    /**
     * Insert Transaction
     * @param $data
     * @return mixed
     */
    public function store($data)
    {

        return Transaction::create(array(
            'idpayment' => $data['payment'],
            'iduser' => $data['user'],
            'idvouchertype' => $data['vouchertype'],
            'idaccounttype' => $data['accounttype'],
            'idtransactiontype' => $data['transactiontype'],
            'idcostcenter' => $data['costcenter'],
            'document' => $data['document'],
            'reference' => 0,
            'description' => $data['description'],
            'nit' => $data['nit'],
            'value' => $data['value'],
            'base' => 0,
            'transaction' => '',
            'term' => 0,
            'date' => $data['date'],
            'realdate' => $data['realdate'],
            "created_by" => getUser()->iduser,
            'created_at' => Carbon::now(),
        ));
    }

    /**
     * Update Transaction
     * @param $transaction
     * @param $data
     * @return mixed
     */
    public function update($transaction, $data)
    {

        //Find Transaction
        $transaction = Transaction::find($transaction);
        $transaction->fill([
            'idvouchertype' => $data['vouchertype'],
            'idaccounttype' => $data['accounttype'],
            'idtransactiontype' => $data['transactiontype'],
            'idcostcenter' => $data['costcenter'],
            'document' => $data['document'],
            'reference' => (isset($data['reference']) ? $data['reference'] : 0),
            'description' => $data['description'],
            'nit' => $data['nit'],
            'value' => $data['value'],
            'base' => $data['base'],
            'transaction' => $data['transaction'],
            'term' => $data['term'],
            'date' => $data['date'],
            "updated_by" => getUser()->iduser,
            'updated_at' => Carbon::now()
        ]);
        return $transaction->save();
    }

    /**
     * Delete Transaction
     * @param $transaction
     * @return mixed
     */
    public function destroy($transaction)
    {
        $transaction = Transaction::find($transaction);
        return $transaction->delete();

    }

    /**
     * Get Transactions By ID
     * @param $payment
     * @return mixed
     */
    public function getTransactionsByPayment($payment)
    {
        return Transaction::select('transactions.*', 'vouchertypes.code AS vouchertype', 'accounttypes.code AS accounttype', 'costcenters.code AS costcenter', DB::raw("CONCAT_WS(CONVERT(' ' USING latin1),users.lastname,users.firstname) AS employee"), 'users.photo')
            ->join('users', function ($join) {
                $join
                    ->on('users.iduser', '=', 'transactions.created_by');
            })
            ->join('vouchertypes', function ($join) {
                $join->on('vouchertypes.idvouchertype', '=', 'transactions.idvouchertype');
            })
            ->join('accounttypes', function ($join) {
                $join->on('accounttypes.idaccounttype', '=', 'transactions.idaccounttype');
            })
            ->join('costcenters', function ($join) {
                $join->on('costcenters.idcostcenter', '=', 'transactions.idcostcenter');
            })
            ->where('transactions.idpayment', "=", $payment)
            ->get();
    }


    /**
     * Find Voucher In Transaction With Payment
     * @param $payment
     * @param $code
     * @return mixed
     */
    public function findVoucherInTransactions($payment, $code)
    {
        return Transaction::select('transactions.*')
            ->join('vouchertypes', function ($join) {
                $join
                    ->on('vouchertypes.idvouchertype', '=', 'transactions.idvouchertype');
            })
            ->where('vouchertypes.code', '=', $code)
            ->where('transactions.idpayment', '=', $payment)
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
}
