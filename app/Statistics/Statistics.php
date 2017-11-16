<?php namespace SigeTurbo\Statistics;

use Illuminate\Support\Facades\DB;
use SigeTurbo\Area;
use SigeTurbo\Repositories\Group\GroupRepository;
use SigeTurbo\Repositories\Subject\SubjectRepository;
use SigeTurbo\Subject;
use SigeTurboArea;

class Statistics
{


    /**
     * Global Performance
     * @param int $year
     * @param int $period
     * @param null $students Estudiantes a Excluir
     * @return mixed
     */
    public static function globalPerformances($year = 1995, $period = 1, $students = null)
    {
        if ($students == null) {
            return DB::select("call globalPerformance($year,$period,999999999)");
        } else {
            return DB::select("call globalPerformance($year,$period,$students)");
        }
    }

    /**
     * Global Performances By Group
     * @param int $year
     * @param int $period
     * @param $students Estudiantes a Excluir
     * @return array
     */
    public static function globalPerformanceByGroup($year = 1995, $period = 1, $students = null)
    {
        $groups = GroupRepository::getGroups($year, $period);
        $data = [];
        foreach ($groups as $group) {
            if ($students == null) {
                $group['data'] = DB::select("call globalPerformanceByGroup($year,$period,$group->idgroup, 999999999)");
            } else {
                $group['data'] = DB::select("call globalPerformanceByGroup($year,$period,$group->idgroup, $students)");
            }
            array_push($data, $group);
        }
        return $data;
    }

    /**
     * Global Performances By Subject
     * @param int $year
     * @param int $period
     * @param $students Estudiantes a Excluir
     * @return array
     */
    public static function globalPerformanceBySubject($year = 1995, $period = 1, $students = null)
    {
        $subjectRepository = new SubjectRepository();
        $subjects = $subjectRepository->getSubjects($year, $period, null, null, 'DESC');
        $data = [];
        foreach ($subjects as $subject) {
            if ($students == null) {
                $subject['data'] = DB::select("call globalPerformanceBySubject($year,$period,$subject->idsubject,999999999)");
            } else {
                $subject['data'] = DB::select("call globalPerformanceBySubject($year,$period,$subject->idsubject,$students)");
            }
            array_push($data, $subject);
        }
        return $data;
    }

    /**
     * Global Performances By Area
     * @param int $year
     * @param int $period
     * @param $students Estudiantes a excluir
     * @return array
     */
    public static function globalPerformanceByArea($year = 1995, $period = 1, $students = null)
    {
        $areas = Area::getAreasByYearAndPeriod($year, $period);
        $data = [];
        foreach ($areas as $area) {
            if ($students == null) {
                $area['data'] = DB::select("call globalPerformanceByArea($year,$period,$area->idarea, 999999999)");
            } else {
                $area['data'] = DB::select("call globalPerformanceByArea($year,$period,$area->idarea, $students)");
            }
            array_push($data, $area);
        }
        return $data;
    }

}