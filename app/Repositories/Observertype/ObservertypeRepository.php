<?php

namespace SigeTurbo\Repositories\Observertype;

use Illuminate\Support\Facades\Cache;
use SigeTurbo\Observertype;

class ObservertypeRepository implements ObservertypeRepositoryInterface {

    /**
     * Return all values
     * @return mixed
     */
    public function all()
    {
        return Cache::remember('observertypes', 1440, function () {
            return Observertype::all();
        });
    }

    /**
     * Find in Databases
     * @param $idobservertype
     * @return mixed
     */
    public function find($idobservertype)
    {
        return Observertype::find($idobservertype);
    }

}
