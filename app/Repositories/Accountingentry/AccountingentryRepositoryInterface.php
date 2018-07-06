<?php

namespace SigeTurbo\Repositories\Accountingentry;

interface AccountingentryRepositoryInterface
{
    public function all();
    public function find($accountingentry);
    public function store($data);
    public function update($accountingentry, $data);
    public function destroy($accountingentry);
    public function getAccountingentriesByReceipt($receipt);
    public function getAccountingentriesByReceiptAndAccounttype($receipt, $accounttype);
    public function getAccountingentriesToExport($code, $date_from, $date_to);
}