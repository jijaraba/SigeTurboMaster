<?php

namespace SigeTurbo\Repositories\Ethnicgroup;

use Illuminate\Support\Facades\Cache;
use SigeTurbo\Ethnicgroup;

class EthnicgroupRepository implements EthnicgroupRepositoryInterface {

    /**
     * Return all values
     * @return mixed
     */
    public function all()
    {
        return Cache::remember('ethnicgroups', 1440, function() {
            return Ethnicgroup::all();
        });
    }

    /**
     * Find in Databases
     * @param $idethnicgroup
     * @return mixed
     */
    public function find($idethnicgroup)
    {
        return Ethnicgroup::find($idethnicgroup);
    }
}
