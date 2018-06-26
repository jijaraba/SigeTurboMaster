<?php


namespace SigeTurbo\Repositories\Concepttype;

use Illuminate\Support\Facades\Cache;
use SigeTurbo\Concepttype;

class ConcepttypeRepository implements ConcepttypeRepositoryInterface
{

    /**
     * Get All Concepttypes
     * @return mixed
     */
    public function all()
    {
        return Cache::remember('concepttypes', 1440, function () {
            return Concepttype::select('*')
                ->whereEnable('Y')
                ->get();
        });
    }

    /**
     * Find Concepttype By ID
     * @param $concepttype
     * @return mixed
     */
    public function find($concepttype)
    {
        return Concepttype::fin($concepttype);
    }
}