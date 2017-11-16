<?php

namespace SigeTurbo\Repositories\Maritalstatus;

use Illuminate\Support\Facades\Cache;
use SigeTurbo\Maritalstatus;

class MaritalstatusRepository implements MaritalstatusRepositoryInterface {

    /**
     * Return all values
     * @return mixed
     */
    public function all()
    {
        return Cache::remember('maritalstatuses', 1440, function() {
            return Maritalstatus::all();
        });
    }

    /**
     * Find in Databases
     * @param $idmaritalstatus
     * @return mixed
     */
    public function find($idmaritalstatus)
    {
        return Maritalstatus::find($idmaritalstatus);
    }

}
