<?php

namespace SigeTurbo\Repositories\Descriptivereport;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use SigeTurbo\Descriptivereport;

class DescriptivereportRepository implements DescriptivereportRepositoryInterface
{

    /**
     * Get All Partials
     * Return all values
     * @return mixed
     */
    public function all()
    {
        return Cache::remember('descriptivereports', 1440, function () {
            return Descriptivereport::all();
        });
    }

    /**
     * Find in Databases
     * @param $iddescriptivereport
     * @return mixed
     */
    public function find($iddescriptivereport)
    {
        return Descriptivereport::find($iddescriptivereport);
    }

    /**
     * Save Descriptivereport
     * @param $data
     * @return static
     */
    public function store($data)
    {
        return Descriptivereport::create(array(
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
     * Update Descriptivereport
     * @param $descriptivereport
     * @param $data
     * @return mixed
     */
    public function update($descriptivereport, $data)
    {
        $descriptivereport = Descriptivereport::find($descriptivereport);
        $descriptivereport->fill(array(
            'description' => $data['description'],
            'updated_by' => getUser()->iduser
        ));
        return $descriptivereport->save();
    }

    /**
     * Delete Descriptivereport
     * @param $descriptivereport
     * @return mixed
     */
    public function destroy($descriptivereport)
    {
        $descriptivereport = Descriptivereport::find($descriptivereport);
        return $descriptivereport->delete();

    }

}
