<?php

namespace SigeTurbo\Repositories\Accounttype;


use Illuminate\Support\Facades\Cache;
use SigeTurbo\Accounttype;

class AccounttypeRepository implements AccounttypeRepositoryInterface
{

    /**
     * Get All Accountypes
     * @return mixed
     */
    public function all()
    {
        return Cache::remember('accounttypes', 1440, function () {
            return Accounttype::all();
        });
    }

    /**
     * Find Accounttype By ID
     * @param $accounttype
     * @return mixed
     */
    public function find($accounttype)
    {
        return Accounttype::find($accounttype);
    }

    /**
     * Find Accountype By Code
     * @param $code
     * @return mixed
     */
    public function findAccountByCode($code)
    {
        return Accounttype::select('*')
            ->whereCode($code)
            ->first();
    }
}