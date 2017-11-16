<?php

namespace SigeTurbo\Repositories\Origeninformation;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use SigeTurbo\Origeninformation;

class OrigeninformationRepository implements OrigeninformationRepositoryInterface
{

    /**
     * Show All origeninformation
     * Return all values
     * @return mixed
     */
    public function all()
    {

        return Cache::remember('origeninformations', 1440, function () {
            return Origeninformation::all();
        });
    }

    /**
     * Find in Databases
     * @param $origeninformation
     * @return mixed
     */
    public function find($origeninformation)
    {
        return Identification::find($origeninformation);
    }

    /**
     * Insert origeninformation
     * @param $data
     * @return mixed
     */
    public function store($data)
    {
        return Origeninformation::create(array(
            'iduser' => $data['origeninformation_user'],
            'idlanguage' => $data['idlanguage'],
            'idcountry' => $data['idcountry'],
            'created_at' => Carbon::now()
        ));
    }


    /**
     * Update origeninformation
     * @param $origeninformation
     * @param $data
     * @return mixed
     */
    public function update($origeninformation, $data)
    {
        //Find origeninformation
        $origeninformation = Origeninformation::find($origeninformation);
        $origeninformation->fill([
            'iduser' => $data['origeninformation_user'],
            'idlanguage' => $data['idlanguage'],
            'idcountry' => $data['idcountry'],
            'updated_at' => Carbon::now()
        ]);
        return $origeninformation->save();

    }

}
