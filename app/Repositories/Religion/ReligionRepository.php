<?php

namespace SigeTurbo\Repositories\Religion;

use Illuminate\Support\Facades\Cache;
use SigeTurbo\Religion;

class ReligionRepository implements ReligionRepositoryInterface {

    /**
     * Return all values
     * @return mixed
     */
    public function all()
    {
        return Cache::remember('religions', 1440, function() {
            return Religion::all();
        });
    }

    /**
     * Find in Databases
     * @param $idreligion
     * @return mixed
     */
    public function find($idreligion)
    {
        return Religion::find($idreligion);
    }

}
