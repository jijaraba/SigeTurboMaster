<?php

namespace SigeTurbo\Repositories\Identification;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use SigeTurbo\Identification;

class IdentificationRepository implements IdentificationRepositoryInterface
{

    /**
     * Show All Identification
     * Return all values
     * @return mixed
     */
    public function all()
    {

        return Cache::remember('identifications', 1440, function () {
            return Identification::all();
        });
    }

    /**
     * Find in Databases
     * @param $identification
     * @return mixed
     */
    public function find($identification)
    {
        return Identification::find($identification);
    }

    /**
     * Insert Identification
     * @param $data
     * @return mixed
     */
    public function store($data)
    {
        return Identification::create(array(
            'iduser' => $data['identification_user'],
            'ididentificationtype' => $data['type'],
            'identification' => $data['identification'],
            'expedition' => $data['expedition'],
            'date' => ($data['date'] == '')? NULL: $data['date'],
            "created_by" => getUser()->iduser,
            'created_at' => Carbon::now(),
        ));
    }


    /**
     * Update Identification
     * @param $identification
     * @param $data
     * @return mixed
     */
    public function update($identification, $data)
    {
        //Find Identification
        $identification = Identification::find($identification);
        $identification->fill([
            'iduser' => $data['identification_user'],
            'ididentificationtype' => $data['type'],
            'identification' => $data['identification'],
            'expedition' => $data['expedition'],
            'date' => ($data['date'] == '')? NULL: $data['date'],
            "updated_by" => getUser()->iduser,
            'updated_at' => Carbon::now()
        ]);
        return $identification->save();

    }

}
