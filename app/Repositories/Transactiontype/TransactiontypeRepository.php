<?php

namespace SigeTurbo\Repositories\Transactiontype;


use Illuminate\Support\Facades\Cache;
use SigeTurbo\Transactiontype;

class TransactiontypeRepository implements TransactiontypeRepositoryInterface
{

    /**
     * Get All Transaction Types
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all()
    {
        return Cache::remember('transactiontypes', 1440, function () {
            return Transactiontype::select('transactiontypes.*')
                ->get();
        });
    }

    /**
     * Find Transaction Type By ID
     * @param $idtransactiontype
     * @return mixed
     */
    public function find($idtransactiontype)
    {
        return Transactiontype::find($idtransactiontype);
    }
}