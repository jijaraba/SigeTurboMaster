<?php

namespace SigeTurbo\Repositories\Bank;

use Illuminate\Support\Facades\Cache;
use SigeTurbo\Bank;

class BankRepository implements BankRepositoryInterface
{

    /**
     * Get All Banks
     * @return mixed
     */
    public function all()
    {
        return Cache::remember('banks', 1440, function () {
            return Bank::all();
        });
    }

    /**
     * Return Bank By ID
     * @param $bank
     * @return mixed
     */
    public function find($bank)
    {
        return Bank::find($bank);
    }
}