<?php

namespace SigeTurbo\Repositories\Gender;

use Illuminate\Support\Facades\Cache;
use SigeTurbo\Gender;

class GenderRepository implements GenderRepositoryInterface {

    /**
     * Return all values
     * @return mixed
     */
    public function all()
    {
        return Cache::remember('genders', 1440, function() {
            return Gender::all();
        });

    }

    /**
     * Find in Databases
     * @param $idgender
     * @return mixed
     */
    public function find($idgender)
    {
        return Gender::find($idgender);
    }

}
