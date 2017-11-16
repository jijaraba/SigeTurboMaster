<?php

namespace SigeTurbo\Repositories\Cost;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use SigeTurbo\Cost;

class CostRepository implements CostRepositoryInterface
{

    /**
     * Get All Costs
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all()
    {
        return Cost::all();
    }

    /**
     * Find Cost
     * @param $cost
     * @return mixed
     */
    public function find($cost)
    {
        return Cost::find($cost);
    }

    /**
     * Find Cost By Group
     * @param $year
     * @param $group
     * @return mixed
     */
    public function costByGroup($year, $group)
    {
        return Cost::select("*")
            ->where('idyear', '=', $year)
            ->where('idgrade', '=', DB::raw("(SELECT idgrade FROM groups WHERE groups.idgroup = $group)"))
            ->first();
    }
}

