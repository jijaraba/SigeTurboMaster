<?php

namespace SigeTurbo\Repositories\Conveyor;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use SigeTurbo\Conveyor;

class ConveyorRepository implements ConveyorRepositoryInterface {

    /**
     * Return all values
     * @return mixed
     */
    public function all()
    {
        //return Conveyor::select('*')->remember(1440,'conveyors');
        return Cache::remember('conveyors', 1440, function() {
            return Conveyor::all();
        });
    }

    /**
     * Find in Databases
     * @param $conveyorId
     * @return mixed
     */
    public function find($conveyorId)
    {
        return Conveyor::find($conveyorId);
    }

    /**
     * Save Conveyor
     * @param $data
     * @return static
     */
    public function store($data)
    {
        return Conveyor::create(array(
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'celular' => $data['celular'],
            'created_at' => Carbon::now()
        ));
    }

    /**
     * Update Conveyor
     * @param $route
     * @param $data
     * @return mixed
     */
    public function update($conveyor,$data)
    {
        $conveyor = Conveyor::find($conveyor);
        $conveyor->fill(array(
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'celular' => $data['celular'],
            'updated_at' => Carbon::now()
         ));
        return $conveyor->save();
    }

    /**
     * Delete Conveyor
     * @param $conveyor
     * @return mixed
     * @internal param $data
     */
    public function destroy($coveyor)
    {
        //Find Convenyor
        $conveyor = Conveyor::find($conveyor);
        return $conveyor->delete();
    }
}