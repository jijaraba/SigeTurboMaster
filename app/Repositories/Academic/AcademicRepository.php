<?php

namespace SigeTurbo\Repositories\Academic;

use Carbon\Carbon;
use Illuminate\Http\Request;
use SigeTurbo\Academic;

class AcademicRepository implements AcademicRepositoryInterface
{

    /**
     * Return all values
     * @return mixed
     */
    public function all()
    {
        return Academic::all();
    }

    /**
     * Find in Databases
     * @param $idacademic
     * @return mixed
     */
    public function find($idacademic)
    {
        return Academic::find($idacademic);
    }

    /**
     * Save Academic
     * @param $data
     * @return static
     */
    public function store($data)
    {
        return Academic::create(array(
            'idyear' => $data['idyear'],
            'idperiod' => $data['idperiod'],
            'idcalendar' => $data['idcalendar'],
            'starts' => $data['starts'],
            'ends' => $data['ends'],
            'rating' => $data['rating'],
            'review' => $data['review'],
            'print' => $data['print'],
            'created_at' => Carbon::now()
        ));
    }

    /**
     * Update Academic
     * @param $academic
     * @param $data
     * @return mixed
     */
    public function update($academic,$data)
    {
        $academic = Academic::find($academic);
        $academic->fill(array(
            'idyear' => $data['idyear'],
            'idperiod' => $data['idperiod'],
            'idcalendar' => $data['idcalendar'],
            'starts' => $data['starts'],
            'ends' => $data['ends'],
            'rating' => $data['rating'],
            'review' => $data['review'],
            'print' => $data['print'],
            'updated_at' => Carbon::now()
        ));
        return $academic->save();

    }

    /**
     * Delete Academic
     * @param $academic
     * @return mixed
     * @internal param $data
     */
    public function destroy($academic)
    {
        //Find Academic
        $academic = Academic::find($academic);
        return $academic->delete();
    }

    /**
     * Get Periods By Year and User
     * @param int $year
     * @param null $user
     * @return mixed
     */
    public function getPeriodsByYear($year = 1995)
    {
        $periods = Academic::select('academics.idperiod', 'periods.name')
            ->join('periods', function ($join) {
                $join
                    ->on('academics.idperiod', '=', 'periods.idperiod');
            })
            ->where('academics.idyear', '=', $year);
        return $periods
            ->groupBy('academics.idperiod')
            ->get();
    }

    /**
     * Get Periods By Year and User
     * @param int $year
     * @param null $user
     * @return mixed
     */
    public function getAcademicsByYear($year = 1995,$period = null)
    {
        $academics = Academic::select('academics.idacademic','academics.idperiod','academics.idyear','academics.idcalendar', 'periods.name As period','calendars.name AS calendar', 'starts', 'ends', 'rating', 'review', 'print')
            ->join('periods', function ($join) {
                $join
                    ->on('academics.idperiod', '=', 'periods.idperiod');
            })
            ->join('calendars', function ($join) {
                $join
                    ->on('academics.idcalendar', '=', 'calendars.idcalendar');
            })
            ->where('academics.idyear', '=', $year);
            if ($period !== null && $period !== "Loading ...") {
                $academics->where('academics.idperiod', '=', $period);
            }
        return $academics
            ->orderBy('academics.idperiod')
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
