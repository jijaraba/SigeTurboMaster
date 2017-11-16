<?php

namespace SigeTurbo\Repositories\Prepaidmedical;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use SigeTurbo\Prepaidmedical;

class PrepaidmedicalRepository implements PrepaidmedicalRepositoryInterface
{

    /**
     * Get All Prepaidmedical
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all()
    {
        return Cache::remember('prepaidmedicals', 1440, function() {
            return Prepaidmedical::all();
        });
    }

    /**
     * Find Prepaidmedical
     * @param $prepaidmedical
     * @return mixed
     */
    public function find($prepaidmedical)
    {
        return Prepaidmedical::find($prepaidmedical);
    }
}