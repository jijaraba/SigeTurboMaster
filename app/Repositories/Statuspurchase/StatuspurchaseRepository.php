<?php

namespace SigeTurbo\Repositories\Statuspurchase;

use Illuminate\Support\Facades\Cache;
use SigeTurbo\Statuspurchase;

class StatuspurchaseRepository implements StatuspurchaseRepositoryInterface
{

    /**
     * Return all values
     * @return mixed
     */
    public function all()
    {
        return Cache::remember('statuspurchases', 1440, function () {
            return Statuspurchase::all();
        });
    }

    /**
     * Find in Databases
     * @param $idstatuspurchase
     * @return mixed
     */
    public function find($idstatuspurchase)
    {
        return Statuspurchase::find($idstatuspurchase);
    }


}