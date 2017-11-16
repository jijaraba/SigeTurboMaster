<?php

namespace SigeTurbo\Repositories\Stratus;

use Illuminate\Support\Facades\Cache;
use SigeTurbo\Stratus;

class StratusRepository implements StratusRepositoryInterface {

    /**
     * Return all values
     * @return mixed
     */
    public function all()
    {
        return Cache::remember('stratuses', 1440, function() {
            return Stratus::all();
        });
    }

    /**
     * Find in Databases
     * @param $idstratus
     * @return mixed
     */
    public function find($idstratus)
    {
        return Stratus::find($idstratus);
    }

}

