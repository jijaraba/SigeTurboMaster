<?php

namespace SigeTurbo\Repositories\Country;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use SigeTurbo\Country;

class CountryRepository implements CountryRepositoryInterface
{

    /**
     * Get All Country
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all()
    {
        return Cache::remember('countries', 1440, function() {
            return Country::all();
        });
    }

    /**
     * Find Country
     * @param $country
     * @return mixed
     */
    public function find($country)
    {
        return Country::find($country);
    }
}