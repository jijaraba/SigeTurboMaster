<?php

namespace SigeTurbo\Repositories\Town;

use Illuminate\Support\Facades\Cache;
use SigeTurbo\Town;

class TownRepository implements TownRepositoryInterface
{

    /**
     * Return all values
     * @return mixed
     */
    public function all()
    {
        return Cache::remember('towns', 1440, function() {
            return Town::all();
        });
    }

    /**
     * Find in Databases
     * @param $idtown
     * @return mixed
     */
    public function find($idtown)
    {
        return Town::find($idtown);
    }


    /**
     * @param $filter
     */
    public function whereArea($filter)
    {
        return Cache::remember('towns', 1440, function() use ($filter){
            return Town::whereArea($filter)->get();
        });
    }

}
