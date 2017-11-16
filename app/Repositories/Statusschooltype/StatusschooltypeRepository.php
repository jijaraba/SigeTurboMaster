<?php

namespace SigeTurbo\Repositories\Statusschooltype;

use Illuminate\Support\Facades\Cache;
use SigeTurbo\Statusschooltype;

class StatusschooltypeRepository implements StatusschooltypeRepositoryInterface {

    /**
     * Return all values
     * @return mixed
     */
    public function all()
    {
        return Cache::remember('statusschooltypes', 1440, function() {
            return Statusschooltype::all();
        });
    }

    /**
     * Find in Databases
     * @param $idstatusschooltype
     * @return mixed
     */
    public function find($idstatusschooltype)
    {
        return Statusschooltype::find($idstatusschooltype);
    }

}
