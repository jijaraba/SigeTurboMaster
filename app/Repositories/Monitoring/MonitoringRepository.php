<?php

namespace SigeTurbo\Repositories\Monitoring;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use SigeTurbo\Monitoring;

class MonitoringRepository implements MonitoringRepositoryInterface
{

    /**
     * Get Monitorings
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all()
    {
        return Monitoring::all();
    }

    /**
     * Find Monitoring
     * @param $idmonitoring
     * @return mixed
     */
    public function find($idmonitoring)
    {
        return Monitoring::find($idmonitoring);
    }

    /**
     * Save Monitoring
     * @param $data
     * @return static
     */
    public function store($data)
    {
        return Monitoring::create([
            'idprovenance' => 1,
            'idyear' => $data['year'],
            'idperiod' => $data['period'],
            'idgroup' => $data['group'],
            'idsubject' => $data['subject'],
            'idnivel' => $data['nivel'],
            'iduser' => $data['user'],
            'idmonitoringtype' => $data['monitoringtype'],
            'rating' => $data['rating'],
            'monitoringable_id' => $data['monitoringtype'],
            "created_by" => getUser()->iduser,
            "updated_by" => getUser()->iduser,
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now(),
        ]);
    }

    /**
     * Update Monitoring
     * @param $monitoring
     * @param $data
     * @return mixed
     */
    public function update($monitoring, $data)
    {
        //Find Monitoring
        $monitoring = Monitoring::find($monitoring);
        $monitoring->fill(array(
            'rating' => $data['rating'],
            'updated_by' => getUser()->iduser,
            "updated_at" => Carbon::now(),
        ));

        return $monitoring->save();

    }

    /**
     * Destroy Monitoring
     * @param $monitoring
     * @return mixed
     */
    public function destroy($monitoring)
    {
        //Find Monitoring
        $monitoring = Monitoring::find($monitoring);
        return $monitoring->delete();

    }

    /**
     * Get Monitorings by User
     * @param $data
     * @return mixed
     */
    public function getMonitoringByUser($data)
    {
        return Monitoring::whereRaw('monitorings.idyear = ? AND monitorings.idperiod = ? AND monitorings.idgroup = ? AND monitorings.idsubject = ? AND monitorings.idnivel = ? AND monitorings.iduser = ?', array($data['year'], $data['period'], $data['group'], $data['subject'], $data['nivel'], $data['user']))
            ->select('monitorings.*', 'monitoringcategories.idmonitoringcategory')
            ->join('monitoringtypes', function ($join) {
                $join->on('monitoringtypes.idmonitoringtype', '=', 'monitorings.idmonitoringtype');
            })
            ->join('monitoringcategories', function ($join) {
                $join->on('monitoringcategories.idmonitoringcategory', '=', 'monitoringtypes.idmonitoringcategory');
            })
            ->orderBy('idmonitoringtype', 'ASC')
            ->get();
    }

    /**
     * Get Performances By Year
     * @param $year
     * @return mixed
     */
    public function globalPerformances($year)
    {
        return Monitoring::select(DB::raw("ANY(idmonitoringtype) AS idmonitoringtype, idmonitoring,CASE WHEN (rating BETWEEN 0.00 AND 2.99) THEN 'DP' ELSE CASE WHEN (rating BETWEEN 3.00 AND 3.70) THEN 'DB' ELSE CASE WHEN (rating BETWEEN 3.71 AND 4.30) THEN 'DA' ELSE CASE WHEN (rating BETWEEN 4.31 AND 5.00) THEN 'DS' END END END END label, CASE WHEN (rating BETWEEN 0.00 AND 2.99) THEN '#ED5565' ELSE CASE WHEN (rating BETWEEN 3.00 AND 3.70) THEN '#FC6E51' ELSE CASE WHEN (rating BETWEEN 3.71 AND 4.30) THEN '#2f9da3' ELSE CASE WHEN (rating BETWEEN 4.31 AND 5.00) THEN '#A0D468' END END END END color,CASE WHEN (rating BETWEEN 0.00 AND 2.99) THEN '#DA4453' ELSE CASE WHEN (rating BETWEEN 3.00 AND 3.70) THEN '#E9573F' ELSE CASE WHEN (rating BETWEEN 3.71 AND 4.30) THEN '#3ababa' ELSE CASE WHEN (rating BETWEEN 4.31 AND 5.00) THEN '#8CC152' END END END END highlight,COUNT(*) value"))
            ->where('monitorings.idyear', '=', $year)
            ->groupBy('label')
            ->get();
    }

    /**
     * Get Monitorings For Parents
     * @param $year
     * @param $period
     * @param $group
     * @param $user
     * @return mixed
     */
    public function getMonitoringsForParents($year, $period, $group, $user)
    {
        return Monitorings::getMonitoringsForParents($year, $period, $group, $user);
    }


    /**
     * Get Monitorings Details for Parents
     * @param $year
     * @param $period
     * @param $group
     * @param $subject
     * @param $nivel
     * @param $user
     * @return mixed
     */
    public function getMonitoringsDetailForParents($year, $period, $group, $subject, $nivel, $user)
    {
        return Monitoring::select('monitorings.idyear', 'monitorings.idperiod', 'monitorings.idgroup', 'monitorings.idsubject', 'monitorings.idnivel', 'iduser', 'monitoringcategories.name AS category', 'monitoringcategorybyyears.percent', DB::raw("CONCAT('[',GROUP_CONCAT(CONCAT('{','\"monitoringtype\"',':','\"',REPLACE(monitoringtypes.name, '\"' , \"'\" ),'\"',',\"rating\"',':','\"',rating,'\"','}') ORDER BY monitoringtypes.name ),']') AS details"), DB::raw("ROUND(AVG(monitorings.rating) * monitoringcategorybyyears.percent, 2) AS average"))
            ->join('monitoringtypes', 'monitorings.idmonitoringtype', '=', 'monitoringtypes.idmonitoringtype')
            ->join('monitoringcategories', 'monitoringtypes.idmonitoringcategory', '=', 'monitoringcategories.idmonitoringcategory')
            ->join('monitoringcategorybyyears', function ($join) {
                $join
                    ->on('monitoringcategories.idmonitoringcategory', '=', 'monitoringcategorybyyears.idmonitoringcategory')
                    ->on('monitoringcategorybyyears.idyear', '=', 'monitoringtypes.idyear')
                    ->on('monitoringcategorybyyears.idsubject', '=', 'monitoringtypes.idsubject');
            })
            ->where('monitorings.idyear', '=', $year)
            ->where('monitorings.idperiod', '=', $period)
            ->where('monitorings.idgroup', '=', $group)
            ->where('monitorings.idsubject', '=', $subject)
            ->where('monitorings.idnivel', '=', $nivel)
            ->where('monitorings.iduser', '=', $user)
            ->groupBy('monitoringcategories.idmonitoringcategory')
            ->orderBy('monitoringcategories.idmonitoringcategory')
            ->get();
    }

    /**
     * Get Monitorings In Current Week By Teacher
     * @param $year
     * @param $period
     * @param $user
     * @return mixed
     */
    public function getMonitoringsInCurrentWeek($year, $period, $user)
    {
        return Monitoring::select('monitorings.*', DB::raw('COUNT(*) AS amount'))
            ->where('monitorings.idyear', '=', $year)
            ->where('monitorings.idperiod', '=', $period)
            ->where('monitorings.created_by', '=', $user)
            ->whereBetween('monitorings.created_at', array(DB::raw('subdate(now(), INTERVAL weekday(now()) DAY)'), DB::raw('adddate(now(), INTERVAL 6-weekday(now()) DAY)')))
            ->groupBy('monitorings.idyear')
            ->groupBy('monitorings.idperiod')
            ->groupBy('monitorings.created_by')
            ->get();
    }
}