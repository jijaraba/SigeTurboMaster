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
}