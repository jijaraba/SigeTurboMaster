<?php

namespace SigeTurbo\Repositories\Area;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use SigeTurbo\Area;

class AreaRepository implements AreaRepositoryInterface {

    /**
     * Return all values
     * @return mixed
     */
    public function all()
    {
        return Area::all();
    }

    /**
     * Find in Databases
     * @param $idareamanager
     * @return mixed
     */
    public function find($idareamanager)
    {
        return Area::find($idareamanager);
    }


    /**
     * Get Area By Years
     * @param $year
     * @return mixed
     */
    public static function getAreasByYear($year)
    {
        return Area::select('areas.name', 'areas.idarea')
            ->whereIn('areas.idarea', function ($query) use ($year) {
                $query
                    ->select('subjects.idarea')
                    ->from('contracts')
                    ->join('subjects', function ($join){
                        $join
                            ->on('subjects.idsubject', '=', 'contracts.idsubject');
                    })
                    ->where('idyear','=', $year)
                    ->get();
            })
            ->orderBy('areas.idarea', 'ASC')
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

