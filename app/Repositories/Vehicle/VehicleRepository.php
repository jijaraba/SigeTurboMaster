<?php

namespace SigeTurbo\Repositories\Vehicle;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use SigeTurbo\Vehicle;

class VehicleRepository implements VehicleRepositoryInterface {

    /**
     * Return all values
     * @return mixed
     */
    public function all()
    {
        //return Vehicle::select('*')->remember(1440,'vehicles');
        return Cache::remember('vehicles', 1440, function() {
            return Vehicle::all();
        });
    }

    /**
     * Find in Databases
     * @param $vehicleId
     * @return mixed
     */
    public function find($vehicleId)
    {
        return Vehicle::find($vehicleId);
    }

    /**
     * Save Vehicle
     * @param $data
     * @return static
     */
    public function store($data)
    {
        return Vehicle::create(array(
            'plate' => $data['plate'],
            'type' => $data['type'],
            'created_at' => Carbon::now()
        ));
    }

    /**
     * Update Vehicle
     * @param $route
     * @param $data
     * @return mixed
     */
    public function update($vehicle,$data)
    {
        $vehicle = Vehicle::find($vehicle);
        $vehicle->fill(array(
            'plate' => $data['plate'],
            'type' => $data['type'],
            'updated_at' => Carbon::now()
         ));
        return $vehicle->save();

    }

    /**
     * Delete Vehicle
     * @param $vehicle
     * @return mixed
     * @internal param $data
     */
    public function destroy($vehicle)
    {
        //Find vehicle
        $vehicle = Vehicle::find($vehicle);
        return $vehicle->delete();
    }
}