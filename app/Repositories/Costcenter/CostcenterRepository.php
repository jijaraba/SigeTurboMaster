<?php

namespace SigeTurbo\Repositories\Costcenter;

use Illuminate\Support\Facades\Cache;
use SigeTurbo\Costcenter;

class CostcenterRepository implements CostcenterRepositoryInterface
{

    /**
     * Get All CostCenter
     * @return mixed
     */
    public function all()
    {
        return Cache::remember('costcenters', 1440, function () {
            return Costcenter::all();
        });
    }

    /**
     * Find Costcenter By ID
     * @param $costcenter
     * @return mixed
     */
    public function find($costcenter)
    {
        return Costcenter::find($costcenter);
    }

    /**
     * Get Costcenter By Code
     * @param $code
     * @return mixed
     */
    public function findCostcenterByCode($code)
    {
        return Costcenter::select('*')
            ->whereCode($code)
            ->first();
    }

}