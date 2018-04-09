<?php

namespace SigeTurbo\Monitorings;

use Illuminate\Support\Facades\DB;
use SigeTurbo\Monitoring;

class Monitorings
{

    public static function getMonitoringsByUser($iduser)
    {

        return Monitoring::select(
            'monitorings.idyear',
            'monitorings.idperiod',
            DB::raw('ANY_VALUE(groups.name) as \'group\''),
            'groups.idgroup',
            DB::raw('CONCAT_WS(CONVERT(\' \' USING latin1),lastname,firstname) AS student'),
            'subjects.idsubject as idsubject',
            'subjects.name as subject',
            'nivels.name as nivel',
            'monitoringtypes.name as monitoring',
            'rating',
            DB::raw('CONCAT(adddate(CURDATE(), INTERVAL 1-DAYOFWEEK(CURDATE()) DAY)," - ",adddate(CURDATE(), INTERVAL 7-DAYOFWEEK(CURDATE()) DAY)) as RangeOfWeek'))
            ->join('users', function ($join) {
                $join->on('users.iduser', '=', 'monitorings.iduser');
            })
            ->join('groups', function ($join) {
                $join->on('groups.idgroup', '=', 'monitorings.idgroup');
            })
            ->join('subjects', function ($join) {
                $join->on('subjects.idsubject', '=', 'monitorings.idsubject');
            })
            ->join('nivels', function ($join) {
                $join->on('nivels.idnivel', '=', 'monitorings.idnivel');
            })
            ->join('monitoringtypes', function ($join) {
                $join->on('monitoringtypes.idmonitoringtype', '=', 'monitorings.idmonitoringtype');
            })
            ->where('users.iduser', '=', $iduser)
            ->whereRaw('monitorings.created_at BETWEEN adddate(CURDATE(), INTERVAL 1-DAYOFWEEK(CURDATE()) DAY) AND adddate(CURDATE(), INTERVAL 7-DAYOFWEEK(CURDATE()) DAY)')
            ->orderBy('groups.idgroup')
            ->orderBy('student')
            ->orderBy('subjects.idsubject')
            ->orderBy('nivels.idnivel')
            ->orderBy('monitoringtypes.name')
            ->get();

    }

    public static function getMonitoringsInCurrentWeek()
    {
        return Monitoring::select(
            "users.iduser",
            DB::raw('ANY_VALUE(groups.name) AS \'group\''),
            DB::raw('CONCAT_WS(CONVERT(\' \' USING LATIN1),firstname, lastname) AS student'),
            DB::raw('COUNT(*) AS amount'),
            DB::raw('CONCAT(ADDDATE(CURDATE(), INTERVAL 1 - DAYOFWEEK(CURDATE()) DAY), \' - \', ADDDATE(CURDATE(), INTERVAL 7 - DAYOFWEEK(CURDATE()) DAY)) AS RangeOfWeek'),
            DB::raw('ANY_VALUE(families.name) AS family'),
            DB::raw('ANY_VALUE(families.idfamily) AS idfamily'),
            'users.idgender')
            ->join('users', function ($join) {
                $join->on('users.iduser', '=', 'monitorings.iduser');
            })
            ->join('groups', function ($join) {
                $join->on('groups.idgroup', '=', 'monitorings.idgroup');
            })
            ->join('userfamilies', function ($join) {
                $join->on('userfamilies.iduser', '=', 'users.iduser');
            })
            ->join('families', function ($join) {
                $join->on('families.idfamily', '=', 'userfamilies.idfamily');
            })
            ->whereRaw('monitorings.created_at BETWEEN ADDDATE(CURDATE(), INTERVAL 1 - DAYOFWEEK(CURDATE()) DAY) AND ADDDATE(CURDATE(), INTERVAL 7 - DAYOFWEEK(CURDATE()) DAY)')
            ->whereRaw('email IS NOT NULL')
            ->groupBy('users.iduser')
            ->orderByRaw('ANY_VALUE(groups.idgroup),student')
            ->get();
    }

    /**
     * Get All Monitorings For Parents
     * @param $year
     * @param $period
     * @param null $group
     * @param $user
     * @return mixed
     */
    public static function getMonitoringsPerformanceByStudent($year, $period, $group = null, $user)
    {
        return DB::select("call globalPerformanceByStudent($year,$period,$group,$user)");
    }

    /**
     * Get All Monitorings For Parents
     * @param $year
     * @param $period
     * @param null $group
     * @param $user
     * @return mixed
     */
    public static function getMonitoringsForParents($year, $period, $group = null, $user)
    {
        return DB::select("call globalPerformanceByStudentForParents($year,$period,$group,$user)");
    }
}