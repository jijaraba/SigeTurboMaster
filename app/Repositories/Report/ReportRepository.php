<?php

namespace SigeTurbo\Repositories\Report;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use SigeTurbo\Report;

class ReportRepository implements ReportRepositoryInterface
{

    /**
     * Get All Reports
     * @return mixed
     */
    public function all()
    {
        return Cache::remember('reports', 1440, function () {
            return Report::all();
        });
    }

    /**
     * Get Report By ID
     * @param $idreport
     * @return mixed
     */
    public function find($idreport)
    {
        return Report::find($idreport);
    }

    /**
     * Save Report
     * @param $data
     * @return mixed
     */
    public function store($data)
    {
        return Report::create(array(
            'idyear' => $data['year'],
            'idperiod' => $data['period'],
            'iduser' => $data['user'],
            'type' => $data['type'],
            'created_by' => getUser()->iduser,
            'created_at' => Carbon::now()
        ));
    }

    /**
     * Get Report By Student
     * @param $year
     * @param $period
     * @param $user
     * @param $type
     * @return mixed
     */
    public function getReportByStudent($year, $period, $user, $type)
    {
        return Report::select('*')
            ->where('idyear', '=', $year)
            ->where('idperiod', '=', $period)
            ->where('iduser', '=', $user)
            ->where('type', '=', $type)
            ->get();
    }

    /**
     * Get Report Enabled
     * @param $year
     * @param $period
     * @param $user
     * @param $type
     * @return mixed
     */
    public function getReportEnabled($year, $period, $user, $type)
    {
        return Report::select('*')
            ->where('idyear', '=', $year)
            ->where('idperiod', '=', $period)
            ->where('iduser', '=', $user)
            ->where('type', '=', $type)
            ->first();
    }
}