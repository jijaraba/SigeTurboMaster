<?php

namespace SigeTurbo\Repositories\Quantitativerecovery;

use Illuminate\Support\Facades\Auth;
use SigeTurbo\Quantitativerecovery;

class QuantitativerecoveryRepository implements QuantitativerecoveryRepositoryInterface {

    /**
     * Return all values
     * @return mixed
     */
    public function all()
    {
        return Quantitativerecovery::select('*')->remember(1440,'quantitativerecoveries');
    }

    /**
     * Find in Databases
     * @param $idquantitativerecovery
     * @return mixed
     */
    public function find($idquantitativerecovery)
    {
        return Quantitativerecovery::find($idquantitativerecovery);
    }

    /**
     * Save Quantitativerecovery
     * @param $data
     * @return static
     */
    public function store($data)
    {
        return Quantitativerecovery::create(array(
            'idyear' => $data['year'],
            'idperiod' => $data['period'],
            'idgroup' => $data['group'],
            'idsubject' => $data['subject'],
            'idnivel' => $data['nivel'],
            'iduser' => $data['user'],
            'rating' => $data['recovery'],
            'created_by' => getUser()->iduser
        ));
    }

    /**
     * Update Quantitativerecovery
     * @param $quantitativerecovery
     * @param $data
     * @return mixed
     */
    public function update($quantitativerecovery,$data)
    {
        $quantitativerecovery = Quantitativerecovery::find($quantitativerecovery);
        $quantitativerecovery->fill(array(
            'rating' => $data['recovery'],
            'updated_by' => getUser()->iduser
        ));
        return $quantitativerecovery->save();

    }

    /**
     * Delete Quantitativerecovery
     * @param $quantitativerecovery
     * @return mixed
     * @internal param $data
     */
    public function destroy($quantitativerecovery)
    {
        //Find Quantitativerecovery
        $quantitativerecovery = Quantitativerecovery::find($quantitativerecovery);
        return $quantitativerecovery->delete();
    }


    /**
     * Get Recovery By User
     * @param $data
     * @return mixed
     */
    public function getRecoveryByUser($data){
        return Quantitativerecovery::where('idyear','=',$data['year'])
            ->where('idperiod','=',$data['period'])
            ->where('idgroup','=',$data['group'])
            ->where('idsubject','=',$data['subject'])
            ->where('idnivel','=',$data['nivel'])
            ->where('iduser','=',$data['user'])
            ->first();
    }

}

