<?php

namespace SigeTurbo\Repositories\Attendance;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use SigeTurbo\Attendance;
use SigeTurbo\Group;
use SigeTurbo\Repositories\Year\YearRepositoryInterface;

class AttendanceRepository implements AttendanceRepositoryInterface
{
    /**
     * @var YearRepositoryInterface
     */
    private $yearRepository;

    /**
     * AttendanceRepository constructor.
     * @param YearRepositoryInterface $yearRepository
     */
    public function __construct(YearRepositoryInterface $yearRepository)
    {
        $this->yearRepository = $yearRepository;
    }

    /**
     * Return all values
     * @return mixed
     */
    public function all()
    {
        return Attendance::all();
    }

    /**
     * Find in Databases
     * @param $idattendance
     * @return mixed
     */
    public function find($idattendance)
    {
        return Attendance::find($idattendance);
    }

    /**
     * Save Attendance
     * @param $data
     * @return static
     */
    public function store($data)
    {
        return Attendance::create(array(
            'idyear' => $data['year'],
            'idperiod' => $data['period'],
            'idgroup' => $data['group'],
            'idsubject' => $data['subject'],
            'idnivel' => $data['nivel'],
            'iduser' => $data['user'],
            'attendance' => $data['attendance'],
            'type' => $data['type'],
            'date' => $data['date'],
            'time' => Carbon::now(),
            'created_by' => getUser()->iduser,
            'updated_by' => getUser()->iduser,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));
    }

    /**
     * Update Attendance
     * @param $attendance
     * @param $data
     * @return mixed
     */
    public function update($attendance, $data)
    {
        //Find Attendance
        $attendance = Attendance::find($attendance);
        $attendance->fill(array(
            'type' => $data['type'],
            'attendance' => $data['attendance'],
            'time' => Carbon::now(),
            'updated_by' => getUser()->iduser,
            'updated_at' => Carbon::now(),
        ));
        return $attendance->save();

    }

    /**
     * Delete Update
     * @param $attendance
     * @return mixed
     * @internal param $data
     */
    public function delete($attendance)
    {
        //Find Attendance
        $attendance = Attendance::find($attendance);
        return $attendance->delete();
    }


    /**
     * Get Attendance Amount By Student
     * @return mixed
     */
    public function getAttendancesAmount()
    {
        return Attendance::select(array(
            'attendances.idyear',
            'attendances.idgroup',
            'attendances.idsubject',
            'attendances.idnivel',
            'attendances.iduser',
            DB::raw("groups.name AS 'groups'"),
            DB::raw('CONCAT_WS(CONVERT(" " USING latin1),users.lastname,users.firstname) AS student'),
            DB::raw('subjects.name AS subject'),
            DB::raw('nivels.name AS nivel'),
            'users.photo',
            DB::raw('SUM(attendances.attendance) as total'),
            'group_max.totals'
        ))
            ->join('users', 'users.iduser', '=', 'attendances.iduser')
            ->join('groups', 'groups.idgroup', '=', 'attendances.idgroup')
            ->join('subjects', 'subjects.idsubject', '=', 'attendances.idsubject')
            ->join('nivels', 'nivels.idnivel', '=', 'attendances.idnivel')
            ->join(DB::raw('(SELECT idyear,idgroup,idsubject,ROUND((((timeintensity*40)*0.20)+1),0) AS totals FROM contracts WHERE contracts.idyear = ' . $this->yearRepository->getCurrentYear()->idyear . ' GROUP BY idyear,idgroup,idsubject,timeintensity) AS group_max'), function ($join) {
                $join
                    ->on('attendances.idyear', '=', 'group_max.idyear')
                    ->on('attendances.idgroup', '=', 'group_max.idgroup')
                    ->on('attendances.idsubject', '=', 'group_max.idsubject');
            }
            )
            ->where('attendances.idyear', '=', $this->yearRepository->getCurrentYear()->idyear)
            ->where('attendances.type', '=', 'Absent')
            ->groupBy('attendances.idyear')
            ->groupBy('attendances.idgroup')
            ->groupBy('attendances.idsubject')
            ->groupBy('attendances.idnivel')
            ->groupBy('attendances.iduser')
            ->groupBy('group_max.totals')
            ->orderBy('total', 'DESC')
            ->orderBy('attendances.idgroup')
            ->limit(5)
            ->get();

    }

    /**
     * Return Student Absent In Preschool
     * @return mixed
     */
    public function getAttendancesLevel01Today()
    {
        return Cache::remember('attendances_level01', 30, function () {
            return Attendance::select("users.iduser", DB::raw('CONCAT_WS(CONVERT(" " USING latin1),users.lastname,users.firstname) AS student'), 'users.photo', 'groups.name AS group', 'subjects.name AS subject', 'attendances.time')
                ->join('users', function ($join) {
                    $join
                        ->on('users.iduser', '=', 'attendances.iduser');
                })
                ->join('groups', function ($join) {
                    $join
                        ->on('groups.idgroup', '=', 'attendances.idgroup');
                })
                ->join('subjects', function ($join) {
                    $join
                        ->on('subjects.idsubject', '=', 'attendances.idsubject');
                })
                ->where('attendances.date', '=', DB::raw('CURDATE()'))
                ->whereIn('groups.idgroup', Group::PRESCHOOL)
                ->whereIn('attendances.type', [Attendance::ABSENT])
                ->get();
        });
    }

    /**
     * Return Student Absent In Primary
     * @return mixed
     */
    public function getAttendancesLevel02Today()
    {
        return Cache::remember('attendances_level02', 30, function () {
            return Attendance::select("users.iduser", DB::raw('CONCAT_WS(CONVERT(" " USING latin1),users.lastname,users.firstname) AS student'), 'users.photo', 'groups.name AS group', 'subjects.name AS subject', 'attendances.time')
                ->join('users', function ($join) {
                    $join
                        ->on('users.iduser', '=', 'attendances.iduser');
                })
                ->join('groups', function ($join) {
                    $join
                        ->on('groups.idgroup', '=', 'attendances.idgroup');
                })
                ->join('subjects', function ($join) {
                    $join
                        ->on('subjects.idsubject', '=', 'attendances.idsubject');
                })
                ->where('attendances.date', '=', DB::raw('CURDATE()'))
                ->whereIn('groups.idgroup', Group::PRIMARY)
                ->whereIn('attendances.type', [Attendance::ABSENT])
                ->get();
        });
    }

    /**
     * Return Student Absent In HighSchool
     * @return mixed
     */
    public function getAttendancesLevel03Today()
    {
        return Cache::remember('attendances_level03', 30, function () {
            return Attendance::select("users.iduser", DB::raw('CONCAT_WS(CONVERT(" " USING latin1),users.lastname,users.firstname) AS student'), 'users.photo', 'groups.name AS group', 'subjects.name AS subject', 'attendances.time')
                ->join('users', function ($join) {
                    $join
                        ->on('users.iduser', '=', 'attendances.iduser');
                })
                ->join('groups', function ($join) {
                    $join
                        ->on('groups.idgroup', '=', 'attendances.idgroup');
                })
                ->join('subjects', function ($join) {
                    $join
                        ->on('subjects.idsubject', '=', 'attendances.idsubject');
                })
                ->where('attendances.date', '=', DB::raw('CURDATE()'))
                ->whereIn('groups.idgroup', Group::HIGHSCHOOL)
                ->whereIn('attendances.type', [Attendance::ABSENT])
                ->get();
        });
    }

    public function edit($attendance)
    {
        // TODO: Implement edit() method.
    }

    /**
     * Show Attendances By Student
     * @param $data
     * @return mixed
     */
    public function showByStudent($data)
    {
        return Attendance::select('attendances.idattendance', "teachers.iduser", DB::raw('CONCAT_WS(CONVERT(" " USING latin1),teachers.lastname,teachers.firstname) AS teacher'), 'teachers.photo', 'groups.name AS group', 'subjects.name AS subject', 'nivels.name AS nivel', 'attendances.type', 'attendances.date', 'attendances.time')
            ->join('users', function ($join) {
                $join
                    ->on('users.iduser', '=', 'attendances.iduser');
            })
            ->join('users as teachers', function ($join) {
                $join
                    ->on('teachers.iduser', '=', 'attendances.created_by');
            })
            ->join('groups', function ($join) {
                $join
                    ->on('groups.idgroup', '=', 'attendances.idgroup');
            })
            ->join('subjects', function ($join) {
                $join
                    ->on('subjects.idsubject', '=', 'attendances.idsubject');
            })
            ->join('nivels', function ($join) {
                $join
                    ->on('nivels.idnivel', '=', 'attendances.idnivel');
            })
            ->where('idyear', '=', $data['year'])
            ->where('idperiod', '=', $data['period'])
            ->where('groups.idgroup', '=', $data['group'])
            ->where('subjects.idsubject', '=', $data['subject'])
            ->where('nivels.idnivel', '=', $data['nivel'])
            ->where('users.iduser', '=', $data['student'])
            ->get();
    }

    /**
     * Get Attendances Amount By Date
     * @param $year
     * @return mixed
     */
    public function getAttendancesAmountByDate($year)
    {
        return Cache::remember('getattendancesamountbydate', 30, function () use ($year) {
            return Attendance::select('attendances.date', DB::raw("COUNT('*') AS amount"))
                ->where('idyear', '=', $year)
                ->groupBy('date')
                ->get();
        });
    }

}