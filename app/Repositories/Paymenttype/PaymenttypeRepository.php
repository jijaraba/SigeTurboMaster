<?php

namespace SigeTurbo\Repositories\Paymenttype;

use SigeTurbo\Paymenttype;

class PaymentRepository implements PaymenttypeRepositoryInterface
{

    /**
     * Get All Paymenttypes
     * @return mixed
     */
    public function all()
    {
        return Cache::remember('paymenttypes', 1440, function () {
            return Paymenttype::all();
        });
    }


    /**
     * Find Paymenttype By ID
     * @param $paymenttype
     * @return mixed
     */
    public function find($paymenttype)
    {
        return Paymenttype::find($paymenttype);
    }
}