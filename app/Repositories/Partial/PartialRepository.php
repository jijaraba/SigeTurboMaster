<?php

namespace SigeTurbo\Repositories\Partial;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use SigeTurbo\Partialrating;

class PartialRepository implements PartialRepositoryInterface
{

    /**
     * Get All Partials
     * Return all values
     * @return mixed
     */
    public function all()
    {
        return Cache::remember('partials', 1440, function () {
            return Partialrating::all();
        });
    }

    /**
     * Find in Databases
     * @param $idpartial
     * @return mixed
     */
    public function find($idpartial)
    {
        return Partialrating::find($idpartial);
    }

    /**
     * Save Partial
     * @param $data
     * @return static
     */
    public function store($data)
    {
        return Partialrating::create(array(
            'idyear' => $data['year'],
            'idperiod' => $data['period'],
            'idgroup' => $data['group'],
            'idsubject' => $data['subject'],
            'idnivel' => $data['nivel'],
            'iduser' => $data['user'],
            'rating' => $data['rating'],
            'description' => $data['description'],
            'created_by' => getUser()->iduser
        ));
    }

    /**
     * Update Partial
     * @param $partial
     * @param $data
     * @return mixed
     */
    public function update($partial, $data)
    {
        $partial = Partialrating::find($partial);
        $partial->fill(array(
            'rating' => $data['rating'],
            'description' => $data['description'],
            'updated_by' => getUser()->iduser
        ));
        return $partial->save();
    }

    /**
     * Delete Partial
     * @param $partial
     * @return mixed
     */
    public function destroy($partial)
    {
        $partial = Partialrating::find($partial);
        return $partial->delete();

    }

}
