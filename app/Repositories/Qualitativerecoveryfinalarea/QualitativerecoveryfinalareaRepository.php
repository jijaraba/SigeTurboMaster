<?php

namespace SigeTurbo\Repositories\Qualitativerecoveryfinalarea;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use SigeTurbo\Qualitativerecoveryfinalarea;

class QualitativerecoveryfinalareaRepository implements QualitativerecoveryfinalareaRepositoryInterface {

    /**
     * Return all values
     * @return mixed
     */
    public function all()
    {
        return Qualitativerecoveryfinalarea::select('*')->remember(1440,'Qualitativerecoveryfinalareas');
    }

    /**
     * Find in Databases
     * @param $idqualitativerecoveryfinalarea
     * @return mixed
     */
    public function find($idqualitativerecoveryfinalarea)
    {
        return Qualitativerecoveryfinalarea::find($idqualitativerecoveryfinalarea);
    }

    /**
     * Save Qualitativerecoveryfinalarea
     * @param $data
     * @return static
     */
    public function store($data)
    {
        return Qualitativerecoveryfinalarea::create(array(
            'idyear' => $data['idyear'],
            'idprovenance' => $data['idprovenance'],
            'idgroup' => $data['idgroup'],
            'idarea' => $data['idarea'],
            'iduser' => $data['iduser'],
            'idteacher' => $data['idteacher'],
            'idassessment' => $data['idassessment'],
            'act' => $data['act'],
            'observation' => $data['observation'],
            'recovery_at' => $data['recovery_at'],
            'created_by' => getUser()->iduser,
            'created_at' => Carbon::now()
        ));
    }

    /**
     * Update Qualitativerecoveryfinalarea
     * @param $qualitativerecoveryfinalarea
     * @param $data
     * @return mixed
     */
    public function update($qualitativerecoveryfinalarea,$data)
    {
        $qualitativerecoveryfinalarea = Qualitativerecoveryfinalarea::find($qualitativerecoveryfinalarea);
        $qualitativerecoveryfinalarea->fill(array(
            'idyear' => $data['idyear'],
            'idprovenance' => $data['idprovenance'],
            'idgroup' => $data['idgroup'],
            'idarea' => $data['idarea'],
            'iduser' => $data['iduser'],
            'idteacher' => $data['idteacher'],
            'idassessment' => $data['idassessment'],
            'act' => $data['act'],
            'observation' => $data['observation'],
            'recovery_at' => $data['recovery_at'],
            'updated_at' => Carbon::now(),
            'updated_by' => getUser()->iduser
        ));
        return $qualitativerecoveryfinalarea->save();

    }

    /**
     * Delete Qualitativerecoveryfinalarea
     * @param $qualitativerecoveryfinalarea
     * @return mixed
     * @internal param $data
     */
    public function destroy($qualitativerecoveryfinalarea)
    {
        //Find Qualitativerecoveryfinalarea
        $qualitativerecoveryfinalarea = Qualitativerecoveryfinalarea::find($qualitativerecoveryfinalarea);
        return $qualitativerecoveryfinalarea->delete();
    }

}