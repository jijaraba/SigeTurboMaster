<?php

namespace SigeTurbo\Repositories\Transaction;

interface TransactionRepositoryInterface
{
    public function all();
    public function find($transaction);
    public function store($data);
    public function update($transaction, $data);
    public function destroy($transaction);
    public function getTransactionsByPayment($payment);
    public function getTransactionsToExport($code,$date_from,$date_to);
}