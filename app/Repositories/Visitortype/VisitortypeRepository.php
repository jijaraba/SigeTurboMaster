<?php

namespace SigeTurbo\Repositories\Visitortype;

use Illuminate\Support\Facades\Cache;
use SigeTurbo\Visitortype;

class VisitortypeRepository implements VisitortypeRepositoryInterface
{

    /**
     * Show All Visitors
     * Return all values
     * @return mixed
     */
    public function all()
    {

        return Cache::remember('visitortypes', 1440, function () {
            return Visitortype::all();
        });
    }

    /**
     * Find in Databases
     * @param $idvisitor
     * @return mixed
     */
    public function find($idvisitor)
    {
        return Visitortype::find($idvisitor);
    }

}
