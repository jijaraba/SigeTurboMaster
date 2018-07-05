<?php

namespace SigeTurbo\Repositories\Receipt;


interface ReceiptRepositoryInterface
{
    public function all();
    public function find($receipt);
    public function store($data);
    public function getReceiptsByVouchertype($vouchertype, $document);
}