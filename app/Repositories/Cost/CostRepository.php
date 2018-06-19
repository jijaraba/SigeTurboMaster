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

    /**
     * Get Cost By Package And Category
     * @param $year
     * @param $grade
     * @param $type |  Concept Type
     * @param $package
     * @param $category | (Invoice|Receipt)
     * @return mixed
     */
    public function getCostsByPackageAndCategory($year, $grade, $type, $package, $category)
    {
        return Cost::select('accounttypes.idaccounttype', 'accounttypes.name AS accounttype', 'costpackages.idtransactiontype', 'costpackages.idtransactiontype AS transactiontype', DB::raw('(costs.value * costpackages.factor) * costpackages.percentage AS value'), 'costpackages.calculated', 'costpackages.factor', 'costpackages.percentage')
            ->join('costpackages', function ($join) {
                $join
                    ->on('costpackages.idaccounttype', '=', 'costs.idaccounttype');
            })
            ->join('accounttypes', function ($join) {
                $join
                    ->on('accounttypes.idaccounttype', '=', 'costs.idaccounttype');
            })
            ->join('vouchercategories', function ($join) {
                $join
                    ->on('vouchercategories.idvouchercategory', '=', 'costpackages.idvouchercategory');
            })
            ->join('packages', function ($join) {
                $join
                    ->on('packages.idpackage', '=', 'costpackages.idpackage');
            })
            ->where('costs.idyear', '=', $year)
            ->where('costs.idgrade', '=', $grade)
            ->where('costs.idconcepttype', '=', $type)
            ->where('packages.idpackage', '=', $package)
            ->where('vouchercategories.idvouchercategory', '=', $category)
            ->get();
    }
}

