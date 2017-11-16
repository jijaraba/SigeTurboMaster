<?php

namespace SigeTurbo\Repositories\Vouchertype;


use Illuminate\Support\Facades\Cache;
use SigeTurbo\Vouchertype;

class VouchertypeRepository implements VouchertypeRepositoryInterface
{

    /**
     * Get All VoucherTypes
     * @return mixed
     */
    public function all()
    {
        return Cache::remember('vouchertypes', 1440, function () {
            return Vouchertype::select('vouchertypes.*')
                ->get();
        });
    }

    /**
     * Find Vouchertype By ID
     * @param $idvouchertype
     * @return mixed
     */
    public function find($idvouchertype)
    {
        return Vouchertype::find($idvouchertype);
    }

    /**
     * Find Vouchertype By Code
     * @param $code
     * @return mixed
     */
    public function findVoucherByCode($code)
    {
        return Vouchertype::select('*')
            ->whereCode($code)
            ->first();
    }
}