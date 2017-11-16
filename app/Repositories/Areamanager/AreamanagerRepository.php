<?php

namespace SigeTurbo\Repositories\Areamanager;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use SigeTurbo\Areamanager;

class AreamanagerRepository implements AreamanagerRepositoryInterface {

    /**
     * Return all values
     * @return mixed
     */
    public function all()
    {
        return Areamanager::all();
    }

    /**
     * Find in Databases
     * @param $idareamanager
     * @return mixed
     */
    public function find($idareamanager)
    {
        return Areamanager::find($idareamanager);
    }


    /**
     * Save Area Manager
     * @param $data
     * @return static
     */
    public function store($data)
    {
        return Areamanager::create(array(
            'idyear' => $data['idyear'],
            'idarea' => $data['idarea'],
            'iduser' => $data['iduser'],
            'created_at' => Carbon::now()
        ));
    }

    /**
     * Update Area Manager
     * @param $areamanager
     * @param $data
     * @return mixed
     */
    public function update($areamanager,$data)
    {
        $areamanager = Areamanager::find($areamanager);
        $areamanager->fill(array(
            'idyear' => $data['idyear'],
            'idarea' => $data['idarea'],
            'iduser' => $data['iduser'],
            'updated_at' => Carbon::now()
        ));
        return $areamanager->save();
    }

    /**
     * Delete Area Manager
     * @param $areamanager
     * @return mixed
     * @internal param $data
     */
    public function destroy($areamanager)
    {
        //Find Area Manager
        $areamanager = Areamanager::find($areamanager);
        return $areamanager->delete();
    }

    /**
     * Get Area Managers By Year Or Areas
     * @param $year
     * @param $area
     * @return mixed
     */
    public static function getAreaManagersByYearOrGroups($year, $area = null)
    {
        $areamanager =  Areamanager::select(
            DB::raw("CONCAT_WS(CONVERT(' ' USING latin1),users.lastname,users.firstname) AS Student"), "idyear",
             'areas.name AS area', 'users.iduser', 'areas.idarea','areamanagers.idareamanager','users.photo'
            )
            ->join('users', function ($join) {
                $join
                    ->on('users.iduser', '=', 'areamanagers.iduser');
            })
            ->join('areas', function ($join) {
                $join
                    ->on('areas.idarea', '=', 'areamanagers.idarea');
            })
            ->where('idyear','=',$year);
            if ($area !== null && $area !== "Loading ...") {
                $areamanager->where('areas.idarea', '=', $area);
            }
         return  $areamanager
                ->orderBy('areas.idarea', 'ASC')
                ->get()
                ;
    }

    /**
     * Get Area Manager By User And Year
     * @param $year
     * @param $group
     * @return mixed
     */
    public static function  getAreaManagerByYearAndUser($year, $user)
    {
        return  Areamanager::where('idyear', '=', $year)->where('iduser', '=', $user)->first();
    }
}

