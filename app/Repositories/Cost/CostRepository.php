<?php

namespace SigeTurbo\Repositories\Cost;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use SigeTurbo\Cost;
use SigeTurbo\Transactiontype;

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

    public function getCostsByPackage($year, $grade, $type, $package)
    {
        return Cost::select('*')
            ->join('costpackages', function ($join) {
                $join
                    ->on('costpackages.idaccounttype', '=', 'costs.idaccounttype');
            })
            ->join('packages', function ($join) {
                $join
                    ->on('packages.idpackage', '=', 'costpackages.idpackage');
            })
            ->where('costs.idyear', '=', $year)
            ->where('costs.idgrade', '=', $grade)
            ->where('costs.idconcepttype', '=', $type)
            ->where('packages.idpackage', '=', $package)
            ->where('costpackages.idtransactiontype', '=', Transactiontype::DEBIT)
            ->get();
    }
}

