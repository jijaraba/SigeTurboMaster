<?php

namespace SigeTurbo\Repositories\Identificationtype;

use Illuminate\Support\Facades\Cache;
use SigeTurbo\Identificationtype;

class IdentificationtypeRepository implements IdentificationtypeRepositoryInterface
{

    /**
     * Show All Identificationtypes
     * Return all values
     * @return mixed
     */
    public function all()
    {
        return Cache::remember('identificationtypes', 1440, function () {
            return Identificationtype::all();
        });
    }

    /**
     * Find in Databases
     * @param $ididentificationtype
     * @return mixed
     */
    public function find($ididentificationtype)
    {
        return Identificationtype::find($ididentificationtype);
    }

}
