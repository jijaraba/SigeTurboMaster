<?php

namespace SigeTurbo\Repositories\Quantitativerecoveryfinalarea;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use SigeTurbo\Quantitativerecoveryfinalarea;

class QuantitativerecoveryfinalareaRepository implements QuantitativerecoveryfinalareaRepositoryInterface {

    /**
     * Return all values
     * @return mixed
     */
    public function all()
    {
        return Quantitativerecoveryfinalarea::select('*')->remember(1440,'quantitativerecoveryfinalareas');
    }

    /**
     * Find in Databases
     * @param $idquantitativerecoveryfinalarea
     * @return mixed
     */
    public function find($idquantitativerecoveryfinalarea)
    {
        return Quantitativerecoveryfinalarea::find($idquantitativerecoveryfinalarea);
    }

    /**
     * Save Quantitativerecoveryfinalarea
     * @param $data
     * @return static
     */
    public function store($data)
    {
        return Quantitativerecoveryfinalarea::create(array(
            'idyear' => $data['idyear'],
            'idprovenance' => $data['idprovenance'],
            'idgroup' => $data['idgroup'],
            'idarea' => $data['idarea'],
            'iduser' => $data['iduser'],
            'idteacher' => $data['idteacher'],
            'rating' => $data['rating'],
            'act' => $data['act'],
            'observation' => $data['observation'],
            'recovery_at' => $data['recovery_at'],
            'created_by' => getUser()->iduser,
            'created_at' => Carbon::now()
        ));
    }

    /**
     * Update Quantitativerecoveryfinalarea
     * @param $quantitativerecoveryfinalarea
     * @param $data
     * @return mixed
     */
    public function update($quantitativerecoveryfinalarea,$data)
    {
        $quantitativerecoveryfinalarea = Quantitativerecoveryfinalarea::find($quantitativerecoveryfinalarea);
        $quantitativerecoveryfinalarea->fill(array(
            'idyear' => $data['idyear'],
            'idprovenance' => $data['idprovenance'],
            'idgroup' => $data['idgroup'],
            'idarea' => $data['idarea'],
            'iduser' => $data['iduser'],
            'idteacher' => $data['idteacher'],
            'rating' => $data['rating'],
            'act' => $data['act'],
            'observation' => $data['observation'],
            'recovery_at' => $data['recovery_at'],
            'updated_at' => Carbon::now(),
            'updated_by' => getUser()->iduser
        ));
        return $quantitativerecoveryfinalarea->save();

    }

    /**
     * Delete Quantitativerecoveryfinalarea
     * @param $quantitativerecoveryfinalarea
     * @return mixed
     * @internal param $data
     */
    public function destroy($quantitativerecoveryfinalarea)
    {
        //Find Quantitativerecoveryfinalarea
        $quantitativerecoveryfinalarea = Quantitativerecoveryfinalarea::find($quantitativerecoveryfinalarea);
        return $quantitativerecoveryfinalarea->delete();
    }


    /**
     * Get Recoveries  By User
     * @param $data
     * @return mixed
     */
    public function getRecoveryByUser($iduser){
             $qualitativerecoveryfinalareas = DB::table('qualitativerecoveryfinalareas')->join('users', function ($join) {
                $join
                    ->on('users.iduser', '=', 'qualitativerecoveryfinalareas.iduser');
            })
            ->join('users AS teachers', function ($join) {
                $join
                    ->on('teachers.iduser', '=', 'qualitativerecoveryfinalareas.idteacher');
            })
            ->join('areas', function ($join) {
                $join
                    ->on('areas.idarea', '=', 'qualitativerecoveryfinalareas.idarea');
            })
            ->join('groups', function ($join) {
                $join
                    ->on('groups.idgroup', '=', 'qualitativerecoveryfinalareas.idgroup');
            })
            ->where('users.iduser', '=', $iduser)
            ->orderBy('idyear', 'DESC')
            ->orderBy('qualitativerecoveryfinalareas.idgroup', 'DESC')
            ->orderBy('areas.name', 'ASC')
              ->select('idqualitativerecoveryfinalarea','idyear', 'idprovenance','users.photo',
            DB::raw("CASE WHEN idprovenance=1 THEN 'Interna' ELSE 'Externa' END AS Provenance"),
            DB::raw("CONCAT_WS(CONVERT(' ' USING latin1),users.lastname,users.firstname) AS Student"),'groups.idgroup','groups.name as grouprecovery',
             'areas.idarea','areas.name AS arearecovey', 'users.iduser',
            'qualitativerecoveryfinalareas.idteacher','teachers.photo AS teacher_photo','teachers.email AS teacher_email',
            DB::raw("CONCAT_WS(CONVERT(' ' USING latin1),teachers.lastname,teachers.firstname) AS teacher"), 
            DB::raw('CASE  WHEN idassessment = 1 THEN  "Excelente"  WHEN idassessment = 2 THEN  "Sobresaliente"  WHEN idassessment = 3 THEN  "Aceptable"  WHEN idassessment = 4 THEN  "Insuficiente" ELSE "Deficiente" END AS rating'), 
            'act', 'observation', 'recovery_at');

            return  Quantitativerecoveryfinalarea::select('idquantitativerecoveryfinalarea','idyear', 'idprovenance','users.photo',
            DB::raw("CASE WHEN idprovenance=1 THEN 'Interna' ELSE 'Externa' END AS Provenance"),
            DB::raw("CONCAT_WS(CONVERT(' ' USING latin1),users.lastname,users.firstname) AS Student"),'groups.idgroup','groups.name as grouprecovery',
             'areas.idarea','areas.name AS arearecovey', 'users.iduser',
            'quantitativerecoveryfinalareas.idteacher','teachers.photo AS teacher_photo','teachers.email AS teacher_email',
            DB::raw("CONCAT_WS(CONVERT(' ' USING latin1),teachers.lastname,teachers.firstname) AS teacher"), 'rating', 'act', 'observation', 'recovery_at')
            ->join('users', function ($join) {
                $join
                    ->on('users.iduser', '=', 'quantitativerecoveryfinalareas.iduser');
            })
            ->join('users AS teachers', function ($join) {
                $join
                    ->on('teachers.iduser', '=', 'quantitativerecoveryfinalareas.idteacher');
            })
            ->join('areas', function ($join) {
                $join
                    ->on('areas.idarea', '=', 'quantitativerecoveryfinalareas.idarea');
            })
            ->join('groups', function ($join) {
                $join
                    ->on('groups.idgroup', '=', 'quantitativerecoveryfinalareas.idgroup');
            })
            ->where('users.iduser', '=', $iduser)
            ->orderBy('idyear', 'DESC')
            ->orderBy('quantitativerecoveryfinalareas.idgroup', 'DESC')
            ->orderBy('areas.name', 'ASC')
            ->unionAll($qualitativerecoveryfinalareas)->get();

             
    }

    /**
     * Get History Academic By Student
     * @param int $year Año académico
     * @param string $users Estudiantes a Mostrar
     * @param string $rating Estudiantes a Mostrar
     * @return mixed
     */
    public function getHistoryByStudent($year = 1995, $users = null, $rating = 5.1){
        if ($users == null) $users = "NULL";
        if ($rating == null) $rating = "NULL";
        return Collection::make(DB::select("call RatingsFinalAreasWithRecoveriesYearsPreviusByStudent($year, ".$users.", ".$rating.")"));
    }

    /**
     * Recoveries Pendings Previous Years
     * @param int $year Año académico
     * @param string $groups Grupos a tener en Cuenta
     * @param string $areas Areas a Tener en Cuenta
     * @param string $status Estados a Tener en Cuenta
     * @param string $users Estudiantes a Mostrar
     * @param string $usersnotin Estudiantes a Excluir
     * @param $students 
     * @return array
     */
    public function recoveriesPendingsPreviousYears($year = 1995, $groups = null,$areas = null, $status = '1,6,5,11', $users = null, $usersnotin = null)
    {
        //dd($year);
        if ($groups == null) $groups = "NULL";
        if ($areas == null) $areas = "NULL";
        if ($status == null) $status = "NULL";
        if ($users == null) $users = "NULL";
        if ($usersnotin == null) $usersnotin = "NULL";
        /*$sentence = "call RecoveriesPendingsPreviousYears($year, ".$groups.", ".$areas.", ".$status.", ".$users.", ".$usersnotin.")";
        dd($sentence);*/
        return Collection::make(DB::select("call RecoveriesPendingsPreviousYears($year, ".$groups.", ".$areas.", '".$status."', ".$users.", ".$usersnotin.")"));
    }

}

