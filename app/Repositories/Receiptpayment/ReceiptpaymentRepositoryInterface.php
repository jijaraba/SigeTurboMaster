<?php

namespace SigeTurbo\Repositories\Receiptpayment;

interface ReceiptpaymentRepositoryInterface
{
    public function all();
    public function find($receiptpayment);
    public function store($data);
}