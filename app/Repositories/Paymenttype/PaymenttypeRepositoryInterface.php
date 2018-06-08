<?php

namespace SigeTurbo\Repositories\Paymenttype;

interface PaymenttypeRepositoryInterface
{
    public function all();
    public function find($paymenttype);
}