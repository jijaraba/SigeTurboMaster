<?php

namespace SigeTurbo\Repositories\Monitoringtype;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use SigeTurbo\Monitoringtype;

class MonitoringtypeRepository implements MonitoringtypeRepositoryInterface
{
    /**
     * Get All Monitoringtypes
     * @return mixed
     */
    public function all()
    {
        return Cache::remember('monitoringtypes', 1440, function () {
            return Monitoringtype::all();
        });
    }

    /**
     * Find Monitoringtype
     * @param $idmonitoringtype
     * @return mixed
     */
    public function find($idmonitoringtype)
    {
        return Monitoringtype::find($idmonitoringtype);
    }


    /**
     * Save Monitoringtype
     * @param $data
     * @return mixed
     */
    public function store($data)
    {
        return Monitoringtype::create(array(
            'idyear' => $data['year'],
            'idperiod' => $data['period'],
            'idgroup' => $data['group'],
            'idsubject' => $data['subject'],
            'idnivel' => $data['nivel'],
            'idmonitoringcategory' => $data['monitoringcategory'],
            'date' => $data['date'],
            'name' => $data['name'],
            'description' => $data['description'],
            'created_by' => getUser()->iduser,
            'updated_by' => getUser()->iduser,
        ));
    }


    /**
     * Get Indicators
     * @param $data
     * @return mixed
     */
    public function getIndicators($data)
    {
        $group = $data['group'];
        return DB::table('indicators')
            ->select('indicators.idindicator', 'indicators.indicator')
            ->join('achievements', function ($join) use ($group) {
                $join->on('indicators.idachievement', '=', 'achievements.idachievement');
            })
            ->where('achievements.idyear', '=', $data['year'])
            ->where('achievements.idperiod', '=', $data['period'])
            ->whereIn('achievements.idgrade', function ($query) use ($group) {
                $query
                    ->select('grades.idgrade')
                    ->from('grades')
                    ->join('groups', function ($join) use ($group) {
                        $join
                            ->on('groups.idgrade', '=', 'grades.idgrade');
                    })->where('groups.idgroup', '=', $group);
            })
            ->where('achievements.idsubject', '=', $data['subject'])
            ->where('achievements.idnivel', '=', $data['nivel'])
            ->whereIn('consecutive', explode(",", $data['indicators']))
            ->where('idindicatortype', '=', 1)
            ->get();
    }


    /**
     * Destroy Monitoringtype
     * @param $monitoringtype
     */
    public function destroy($monitoringtype)
    {
        $monitoringtype = Monitoringtype::find($monitoringtype);
        return $monitoringtype->delete();
    }

    /**
     * Get Monitoringtypes For Chart
     * @param $data
     * @return mixed
     */
    public function getMonitoringtypesForChart($data)
    {
        return Monitoringtype::select('monitoringtypes.*','users.photo','users.firstname','users.lastname')
            ->whereRaw('idyear = ? AND idperiod = ? AND idgroup = ? AND idsubject = ? AND idnivel = ?', array($data['year'], $data['period'], $data['group'], $data['subject'], $data['nivel']))
            ->join('users', function ($join)  {
                $join->on('users.iduser', '=', 'monitoringtypes.created_by');
            })
            ->orderBy('idmonitoringcategory', 'ASC')
            ->orderBy('created_at', 'ASC')
            ->orderBy('idmonitoringcategory', 'ASC')
            ->with('monitoringtypeindicator')
            ->with('data')
            ->get();
    }

    /**
     * Get Monitoringtypes
     * @param $data
     * @return mixed
     */
    public function getMonitoringtypes($data)
    {
        return Monitoringtype::whereRaw('idyear = ? AND idperiod = ? AND idgroup = ? AND idsubject = ? AND idnivel = ?', array($data['year'], $data['period'], $data['group'], $data['subject'], $data['nivel']))
            ->orderBy('idmonitoringcategory', 'ASC')
            ->orderBy('created_at', 'ASC')
            ->orderBy('idmonitoringcategory', 'ASC')
            ->get();
    }

    /**
     * Get Monitoring By Category
     * @param $data
     * @return mixed
     */
    public function getMonitoringByCategory($data)
    {
        return Monitoringtype::whereRaw('idyear = ? AND idperiod = ? AND idgroup = ? AND idsubject = ? AND idnivel = ? AND idmonitoringcategory = ?', array($data['year'], $data['period'], $data['group'], $data['subject'], $data['nivel'], $data['monitoringcategory']))
            ->orderBy('idmonitoringcategory', 'ASC')
            ->get();
    }
}