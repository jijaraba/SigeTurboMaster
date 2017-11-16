<?php

namespace SigeTurbo\Repositories\Vouchertype;


interface VouchertypeRepositoryInterface
{
    public function all();
    public function find($idvouchertype);
    public function findVoucherByCode($code);
}