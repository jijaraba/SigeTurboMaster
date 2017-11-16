<?php

namespace SigeTurbo\Repositories\Bloodtype;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use SigeTurbo\Bloodtype;

class BloodtypeRepository implements BloodtypeRepositoryInterface
{

    /**
     * Get All Bloodtype
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all()
    {
        return Cache::remember('bloodtypes', 1440, function() {
            return Bloodtype::all();
        });
    }

    /**
     * Find Bloodtype
     * @param $bloodtype
     * @return mixed
     */
    public function find($bloodtype)
    {
        return Bloodtype::find($bloodtype);
    }
}