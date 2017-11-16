<?php

namespace SigeTurbo\Repositories\Groupdirector;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use SigeTurbo\Groupdirector;

class GroupdirectorRepository implements GroupdirectorRepositoryInterface
{
    /**
     * @return mixed
     */
    public function all()
    {
        return Groupdirector::all();
    }

    /**
     * @param $idgroupdirector
     * @return mixed
     */
    public function find($idgroupdirector)
    {
        return Groupdirector::find($idgroupdirector);
    }

    /**
     * Save Director Group
     * @param $data
     * @return static
     */
    public function store($data)
    {
        return Groupdirector::create(array(
            'idyear' => $data['idyear'],
            'idgroup' => $data['idgroup'],
            'iduser' => $data['iduser'],
            'created_at' => Carbon::now()
        ));
    }

    /**
     * Update Director Group
     * @param $groupdirector
     * @param $data
     * @return mixed
     */
    public function update($groupdirector,$data)
    {
        $groupdirector = Groupdirector::find($groupdirector);
        $groupdirector->fill(array(
            'idyear' => $data['idyear'],
            'idgroup' => $data['idgroup'],
            'iduser' => $data['iduser'],
            'updated_at' => Carbon::now()
        ));
        return $groupdirector->save();

    }

    /**
     * Delete Director Group
     * @param $groupdirector
     * @return mixed
     * @internal param $data
     */
    public function destroy($groupdirector)
    {
        //Find Director Group
        $groupdirector = Groupdirector::find($groupdirector);
        return $groupdirector->delete();
    }

    /**
     * Get Director Group
     * @param $year
     * @param $group
     * @return mixed
     */
    public static function getName($year, $group)
    {
        return Groupdirector::select('users.*')
            ->join('users', function ($join) {
                $join
                    ->on('users.iduser', '=', 'groupdirectors.iduser');
            })
            ->where('idyear','=',$year)
            ->where('idgroup','=',$group)
            ->get();
    }


    /**
     * Get Groups Directors By Year Or Groups
     * @param $year
     * @param $group
     * @return mixed
     */
    public static function getGroupsDirectorsByYearOrGroups($year, $group = null)
    {
        $groupdirector =  Groupdirector::select(
            DB::raw("CONCAT_WS(CONVERT(' ' USING latin1),users.lastname,users.firstname) AS Student"), "idyear",
             'groups.name AS group', 'users.iduser', 'groups.idgroup','groupdirectors.idgroupdirector','users.photo'
            )
            ->join('users', function ($join) {
                $join
                    ->on('users.iduser', '=', 'groupdirectors.iduser');
            })
            ->join('groups', function ($join) {
                $join
                    ->on('groups.idgroup', '=', 'groupdirectors.idgroup');
            })
            ->where('idyear','=',$year);
            if ($group !== null && $group !== "Loading ...") {
                $groupdirector->where('groups.idgroup', '=', $group);
            }
         return  $groupdirector
                ->orderBy('groups.idgroup', 'ASC')
                ->get()
                ;
    }

    /**
     * Get Groups Directors By Year And User
     * @param $year
     * @param $group
     * @return mixed
     */
    public static function  getGroupDirectorByYearAndUser($year, $user)
    {
        return  Groupdirector::where('idyear', '=', $year)->where('iduser', '=', $user)->first();
    }
}