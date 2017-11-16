<?php

namespace SigeTurbo\Repositories\Subject;

use Illuminate\Support\Facades\Cache;
use SigeTurbo\Subject;

class SubjectRepository implements SubjectRepositoryInterface
{
    /**
     * Get All Subjects
     * @return mixed
     */
    public function all()
    {
        return Cache::remember('subjects', 1440, function () {
            return Subject::all();
        });
    }

    /**
     * Find Subject
     * @param $idsubject
     * @return mixed
     */
    public function find($idsubject)
    {
        return Subject::find($idsubject);
    }

    /**
     * Get Subjects By Year and Period and Group and User
     * @param int $year
     * @param int $period
     * @param null $group
     * @param null $user
     * @param String $type
     * @return mixed
     */
    public function getSubjects($year = 1995, $period = 1, $group = null, $user = null, $type = 'ASC')
    {
        $subjects = Subject::select('subjects.idsubject', 'subjects.name', 'subjects.shortname')
            ->join('areas', 'areas.idarea', '=', 'subjects.idarea')
            ->join('contracts', 'contracts.idsubject', '=', 'subjects.idsubject')
            ->join('years', 'years.idyear', '=', 'contracts.idyear')
            ->join('periods', 'periods.idperiod', '=', 'contracts.idperiod')
            ->join('groups', 'groups.idgroup', '=', 'contracts.idgroup')
            ->where('years.idyear', '=', $year)
            ->where('periods.idperiod', '=', $period)
            ->orderBy('areas.order', $type);
        if ($group) {
            $subjects
                ->where('groups.idgroup', '=', $group);
        }
        if ($user) {
            $subjects
                ->join('users', 'users.iduser', '=', 'contracts.iduser')
                ->where('users.iduser', '=', $user);
        }
        return $subjects
            ->groupBy('subjects.idsubject')
            ->get();
    }

    /**
     * Get Subjects By Year and Period and Group and User and Area
     * @param int $year
     * @param int $period
     * @param null $group
     * @param null $user
     * @param String $type
     * @return mixed
     */
    public function getSubjectsByArea($year = 1995, $period = 1, $group = null, $user = null, $type = 'ASC')
    {
        $subjects = Subject::select('subjects.idsubject', 'subjects.name', 'subjects.shortname')
            ->join('areas', 'areas.idarea', '=', 'subjects.idarea')
            ->join('contracts', 'contracts.idsubject', '=', 'subjects.idsubject')
            ->join('areamanagers', 'areamanagers.idarea', '=', 'subjects.idarea')
            ->join('years', 'years.idyear', '=', 'contracts.idyear')
            ->join('periods', 'periods.idperiod', '=', 'contracts.idperiod')
            ->join('groups', 'groups.idgroup', '=', 'contracts.idgroup')
            ->where('years.idyear', '=', $year)
            ->where('periods.idperiod', '=', $period)
            ->orderBy('areas.order', $type);
        if ($group) {
            $subjects
                ->where('groups.idgroup', '=', $group);
        }
        if ($user) {
            $subjects
                ->join('users', 'users.iduser', '=', 'areamanagers.iduser')
                ->where('users.iduser', '=', $user);
        }
        return $subjects
            ->groupBy('subjects.idsubject')
            ->get();
    }

    public function getSubjectsWithoutPeriod($year = 1995)
    {
        return Cache::remember('subjectswithoutperiod', 1440, function () use ($year) {
            return Subject::select('subjects.idsubject', 'subjects.name')
                ->join('contracts', 'contracts.idsubject', '=', 'subjects.idsubject')
                ->join('years', 'years.idyear', '=', 'contracts.idyear')
                ->join('groups', 'groups.idgroup', '=', 'contracts.idgroup')
                ->join('areas', 'areas.idarea', '=', 'subjects.idarea')
                ->where('years.idyear', '=', $year)
                ->groupBy('subjects.idsubject')
                ->orderBy('areas.order')
                ->get();
        });
    }

    /**
     * Get Subjects By Years
     * @param $year
     * @param $subject
     * @return mixed
     */
    public static function getSubjectsByYear($year)
    {
        return Subject::select('subjects.name', 'subjects.idsubject')
            ->whereIn('subjects.idsubject', function ($query) use ($year) {
                $query
                    ->select('monitoringcategorybyyears.idsubject')
                    ->from('monitoringcategorybyyears')
                    ->where('idyear','=', $year)
                    ->get();
            })
            ->orderBy('subjects.idsubject', 'ASC')
                ->get()
            ;
    }


    /**
     * Get Subjects With Areas And Nivels
     * @param $subject
     * @return mixed
     */
    public static function getSubjectsWithAreasAndNivels($subject = null)
    {
        $subjects = Subject::select('areas.idarea', 'areas.name as area', 'areas.shortname', 'areas.prefix',
                                    'description', 'isPrinteable', 'areas.order', 'active','idnivel', 'subjects.idsubject',
                                    'subjects.name AS subjectname','subjects.shortname as shrotnamesubject', 
                                    'subjects.prefix as prefixsubject','nivels.name AS nivelname'
            )
                ->join('areas', 'areas.idarea', '=', 'subjects.idarea')
                ->join('nivels', 'nivels.idsubject', '=', 'subjects.idsubject');
                if ($subject) {
                    $subjects->where('subjects.idsubject', '=', $subject);
                }
        return $subjects
                ->orderBy('areas.order', 'ASC')
                ->orderBy('subjects.idsubject', 'ASC')
                ->orderBy('nivels.name', 'ASC')
                //;
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