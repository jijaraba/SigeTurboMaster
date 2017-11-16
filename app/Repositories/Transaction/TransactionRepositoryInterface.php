<?php

namespace SigeTurbo\Repositories\Transaction;

interface TransactionRepositoryInterface
{
    public function all();
    public function find($idtransaction);
    public function store($data);
    public function update($transaction, $data);
    public function destroy($transaction);
    public function getTransactionsByPayment($payment);
    public function getTransactionsToExport($code,$dateinit,$datefinish);
}