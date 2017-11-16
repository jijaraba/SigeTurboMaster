<?php

namespace SigeTurbo\Repositories\Monitoringcategorybyyear;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use SigeTurbo\Monitoringcategorybyyear;

class MonitoringcategorybyyearRepository implements MonitoringcategorybyyearRepositoryInterface
{
    /**
     * Get All Monitoringcategorybyyears
     * @return mixed
     */
    public function all()
    {
        return Cache::remember('monitoringcategorybyyears', 1440, function () {
            return Monitoringcategorybyyear::all();
        });
    }

    /**
     * Find Monitoringcategorybyyear
     * @param $idmonitoringcategorybyyear
     * @return mixed
     */
    public function find($idmonitoringcategorybyyear)
    {
        return Monitoringcategorybyyear::find($idmonitoringcategorybyyear);
    }

    /**
     * Save Monitoring Category By Year
     * @param $data
     * @return static
     */
    public function store($data)
    {
        return Monitoringcategorybyyear::create(array(
            'idyear' => $data['idyear'],
            'idsubject' => $data['idsubject'],
            'idmonitoringcategory' => $data['idmonitoringcategory'],
            'percent' => $data['percent'],
            'created_at' => Carbon::now()
        ));
    }

    /**
     * Update Monitoring Category By Year
     * @param $areamanager
     * @param $data
     * @return mixed
     */
    public function update($monitoringcategorybyyear,$data)
    {
        $monitoringcategorybyyear = Monitoringcategorybyyear::find($monitoringcategorybyyear);
        $monitoringcategorybyyear->fill(array(
            'idyear' => $data['idyear'],
            'idsubject' => $data['idsubject'],
            'idmonitoringcategory' => $data['idmonitoringcategory'],
            'percent' => $data['percent'],
            'updated_at' => Carbon::now()
        ));
        return $monitoringcategorybyyear->save();
    }

    /**
     * Delete Monitoring Category By Year
     * @param $areamanager
     * @return mixed
     * @internal param $data
     */
    public function destroy($monitoringcategorybyyear)
    {
        //Find Monitoring Category By Year
        $monitoringcategorybyyear = Monitoringcategorybyyear::find($monitoringcategorybyyear);
        return $monitoringcategorybyyear->delete();
    }

    /**
     * Get Monitoringcategorybyyears
     * @param $year
     * @param $subject
     * @return mixed
     */
    public function getMonitoringcategorybyyears($year,$subject){
        return DB::table('monitoringcategorybyyears')
            ->join('monitoringcategories', 'monitoringcategorybyyears.idmonitoringcategory', '=', 'monitoringcategories.idmonitoringcategory')
            ->select('monitoringcategorybyyears.idmonitoringcategory', 'monitoringcategories.name', 'monitoringcategorybyyears.percent')
            ->where('monitoringcategorybyyears.idyear', '=', DB::raw($year))
            ->where('monitoringcategorybyyears.idsubject', '=', DB::raw($subject))
            ->get();
    }

        /**
     * Get Area By Years
     * @param $year
     * @return mixed
     */
    public static function getMonitoringcategorybyyearDetail($year,$subject = null)
    {
        $monitoringcategorybyyear =  Monitoringcategorybyyear::select( "monitoringcategories.name AS category","monitoringcategorybyyears.idyear",
             'subjects.name AS subject', 'monitoringcategorybyyears.percent', 'monitoringcategorybyyears.idsubject',
             'monitoringcategorybyyears.idmonitoringcategory','monitoringcategorybyyears.idmonitoringcategorybyyear'
            )
            ->join('monitoringcategories', function ($join) {
                $join
                    ->on('monitoringcategories.idmonitoringcategory', '=', 'monitoringcategorybyyears.idmonitoringcategory');
            })
            ->join('subjects', function ($join) {
                $join
                    ->on('subjects.idsubject', '=', 'monitoringcategorybyyears.idsubject');
            })
            ->where('idyear','=',$year);
            if ($subject !== null && $subject !== "Loading ...") {
                $monitoringcategorybyyear->where('monitoringcategorybyyears.idsubject', '=', $subject);
            }
         return  $monitoringcategorybyyear
                ->orderBy('subjects.idsubject', 'ASC')
                ->orderBy('monitoringcategorybyyears.percent', 'ASC')
                ->get()
                ;
    }

    // Previamente la consulta nunca debe llegar aqui con un  ->get pues no daría
    //https://stackoverflow.com/questions/18236294/how-do-i-get-the-query-builder-to-output-its-raw-sql-query-as-a-string
    public static function getQuerySyntax($objetiluminate)
    {
        $result['Parameters'] = $objetiluminate->getBindings();
        $query = str_replace(array('%', '?'), array('%%', '%s'), $objetiluminate->toSql());
        $query = vsprintf($query, $objetiluminate->getBindings());
        $result['query'] = $query;
        return $result;
    }


}