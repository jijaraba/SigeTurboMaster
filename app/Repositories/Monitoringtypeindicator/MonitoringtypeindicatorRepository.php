<?php

namespace SigeTurbo\Repositories\Monitoringtypeindicator;

use SigeTurbo\Monitoringtypeindicator;

class MonitoringtypeindicatorRepository implements MonitoringtypeindicatorRepositoryInterface
{
    /**
     * Get All Monitoringtypeindicators
     * @return mixed
     */
    public function all()
    {
        return Cache::remember('monitoringtypeindicators', 1440, function () {
            return Monitoringtypeindicator::all();
        });
    }

    /**
     * Find Monitoringtypeindicator
     * @param $idmonitoringtypeindicator
     * @return mixed
     */
    public function find($idmonitoringtypeindicator)
    {
        return Monitoringtypeindicator::find($idmonitoringtypeindicator);
    }


    /**
     * Save Monitoringtypeindicator
     * @param $data
     * @return mixed
     */
    public function store($data)
    {
        return Monitoringtypeindicator::create(array(
            'idmonitoringtype' => $data['monitoringtype'],
            'idindicator' => $data['indicator'],
        ));
    }

    /**
     * Destroy Monitoringtypeindicator
     * @param $monitoringtypeindicator
     */
    public function destroy($monitoringtypeindicator)
    {
        $monitoringtypeindicator = Monitoringtypeindicator::find($monitoringtypeindicator);
        return $monitoringtypeindicator->delete();
    }

}