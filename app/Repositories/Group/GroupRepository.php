<?php

namespace SigeTurbo\Repositories\Group;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use SigeTurbo\Group;

class GroupRepository implements GroupRepositoryInterface
{
    /**
     * @return mixed
     */
    public function all()
    {
        return Cache::remember('groups', 1440, function () {
            return Group::all();
        });
    }

    /**
     * @param $idgroup
     * @return mixed
     */
    public function find($idgroup)
    {
        return Group::find($idgroup);
    }

    /**
     * Get Groups for Guest
     * @param int $year
     * @param int $period
     * @return mixed
     */
    public static function getGroupsForGuest($year = 1995, $period = 1)
    {
        return Cache::remember('groups', 1440, function () use ($year, $period) {
            return Group::select('groups.idgroup', 'groups.name')
                ->join('contracts', 'contracts.idgroup', '=', 'groups.idgroup')
                ->where('contracts.idyear', '=', $year)
                ->where('contracts.idperiod', '=', $period)
                ->orderBy('groups.idgroup')
                ->groupBy('contracts.idgroup')
                ->get();
        });
    }


    /**
     * Get Groups for Teacher
     * @param int $year
     * @param int $period
     * @param null $user
     * @return mixed
     */
    public static function getGroups($year = 1995, $period = 1, $user = null)
    {

        $groups = Group::select('groups.idgroup', 'groups.name')
            ->join('contracts', 'contracts.idgroup', '=', 'groups.idgroup')
            ->where('contracts.idyear', '=', $year)
            ->where('contracts.idperiod', '=', $period)
            ->orderBy('groups.idgroup');
        if ($user !== null) {
            $groups
                ->where('contracts.iduser', '=', $user);
        }
        return $groups
            ->groupBy('contracts.idgroup')
            ->get();
    }

    /**
     * Get Groups for Observers
     * @param int $year
     * @return mixed
     */
    public static function getGroupsForObservator($year = 1995)
    {

        $groups = Group::select('groups.idgroup', 'groups.name')
            ->join('groupdirectors', 'groupdirectors.idgroup', '=', 'groups.idgroup')
            ->where('groupdirectors.idyear', '=', $year)
            ->orderBy('groups.idgroup');
        return $groups
            ->get();
    }

    /**
     * Get Groups For Area Manager
     * @param int $year
     * @param int $period
     * @param null $user
     * @return mixed
     */
    public static function getGroupsByAreaManager($year = 1995, $period = 1, $user = null)
    {
        $groups = Group::select('groups.idgroup', 'groups.name')
            ->join('contracts', 'contracts.idgroup', '=', 'groups.idgroup')
            ->join('subjects', function ($join) {
                $join
                    ->on('subjects.idsubject', '=', 'contracts.idsubject');
            })
            ->join('areamanagers', function ($join) {
                $join
                    ->on('areamanagers.idarea', '=', 'subjects.idarea');
            })
            ->where('contracts.idyear', '=', $year)
            ->where('contracts.idperiod', '=', $period)
            ->orderBy('groups.idgroup');
        if ($user !== null) {
            $groups
                ->where('areamanagers.iduser', '=', $user);
        }
        return $groups
            ->groupBy('contracts.idgroup')
            ->get();
    }

    /**
     * Get Latest Group By Student
     * @param $user
     * @return mixed
     */
    public static function getLatestGroupByStudent($user)
    {
        return Group::select("idgroup", "idgrade", 'name')
            ->where('idgroup', '=', DB::raw("(SELECT MAX(idgroup) AS idgroup FROM enrollments WHERE iduser = $user)"))
            ->first();
    }
}
