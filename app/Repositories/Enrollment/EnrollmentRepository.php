<?php

namespace SigeTurbo\Repositories\Enrollment;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use SigeTurbo\Enrollment;
use SigeTurbo\Statusschooltype;

class EnrollmentRepository implements EnrollmentRepositoryInterface
{

    /**
     * Return all values
     * @return mixed
     */
    public function all()
    {
        return Cache::remember('enrollments', 1440, function () {
            return Enrollment::all();
        });
    }

    /**
     * Find in Databases
     * @param $idenrollment
     * @return mixed
     */
    public function find($idenrollment)
    {
        return Enrollment::find($idenrollment);
    }

    /**
     * Create Enrollment
     * @param $data
     * @return static
     */
    public function store($data)
    {
        return Enrollment::create([
            'idyear' => $data['year'],
            'idgroup' => $data['group'],
            'iduser' => $data['student'],
            'register' => $data['register'],
            'idstatusschooltype' => $data['status'],
            'statusdate' => $data['statusdate'],
            'scholarship' => $data['scholarship'],
            'reentry' => $data['reentry'],
            'inclusion' => $data['inclusion'],
            'fieldtrip' => $data['fieldtrip'],
            'isapprovedyear' => $data['isapprovedyear'],
            'observation' => $data['observation'],
            'created_by' => getUser()->iduser,
            'updated_by' => getUser()->iduser,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }

    /**
     * Update Enrollment
     * @param $enrollment
     * @param $data
     * @return mixed
     */
    public function update($enrollment, $data)
    {
        //Find Enrollment
        $enrollment = Enrollment::find($enrollment);
        $enrollment->fill(array(
            'idyear' => $data['year'],
            'idgroup' => $data['group'],
            'register' => $data['register'],
            'idstatusschooltype' => $data['status'],
            'statusdate' => $data['statusdate'],
            'scholarship' => $data['scholarship'],
            'reentry' => $data['reentry'],
            'inclusion' => $data['inclusion'],
            'fieldtrip' => $data['fieldtrip'],
            'isapprovedyear' => $data['isapprovedyear'],
            'observation' => $data['observation'],
            'updated_by' => getUser()->iduser,
            'updated_at' => Carbon::now(),
        ));
        return $enrollment->save();
    }

    /**
     * @param int $year
     * @param int $group
     * @param array $category
     * @param array $types
     * @param array $search
     * @param null $sort
     * @param string $order
     * @param array $exclude
     * @return mixed
     */
    public function getEnrollments($year, $group = null, $category = [], $types = [], $search = [], $sort = null, $order = 'ASC', $exclude = [])
    {


        $enrollments = Enrollment::select('users.iduser', 'users.firstname', 'users.lastname', 'users.photo', 'enrollments.idstatusschooltype AS status', 'users.idgender AS gender', 'birth', 'inclusion', 'enrollments.register', 'groups.name AS group', 'statusschooltypes.name AS statusName', 'groups.idgroup', 'enrollments.scholarship')
            ->join('users', function ($join) {
                $join
                    ->on('enrollments.iduser', '=', 'users.iduser');
            })
            ->join('groups', function ($join) {
                $join
                    ->on('enrollments.idgroup', '=', 'groups.idgroup');
            })
            ->join('statusschooltypes', function ($join) {
                $join
                    ->on('enrollments.idstatusschooltype', '=', 'statusschooltypes.idstatusschooltype');
            })
            ->where('enrollments.idyear', '=', $year);

        //Group
        if (is_scalar($group)) {
            $enrollments->where('groups.idgroup', '=', $group);
        }

        //Category
        if (is_array($category) && count($category) > 0) {
            $enrollments
                ->whereIn('users.idcategory', $category);
        }

        //Statusschooltype
        if (is_array($types) && count($types) > 0) {
            $enrollments
                ->whereIn('enrollments.idstatusschooltype', $types);
        }

        //Exclude
        if (is_array($exclude) && count($exclude) > 0) {
            $enrollments
                ->whereNotIn('users.iduser', $exclude);
        }

        //Search
        if ($search !== null) {
            if (isset($search["code"])) {
                $enrollments
                    ->where('users.iduser', 'LIKE', "%" . $search['code'] . "%");
            }
            if (isset($search["firstname"])) {
                $enrollments
                    ->where('users.firstname', 'LIKE', "%" . $search['firstname'] . "%");
            }
            if (isset($search["lastname"])) {
                $enrollments
                    ->where('users.lastname', 'LIKE', "%" . $search['lastname'] . "%");
            }
        }

        //Sort
        switch ($sort) {
            case 'group':
                $enrollments
                    ->orderBy('groups.order', $order)
                    ->orderBy('users.lastname')
                    ->orderBy('users.firstname');
                break;
            case 'status':
                $enrollments
                    ->orderBy('enrollments.idstatusschooltype', $order);
                break;
            case 'register':
                $enrollments
                    ->orderBy('enrollments.register', $order)
                    ->orderBy('users.lastname')
                    ->orderBy('users.firstname');
                break;
            case 'created_at':
                $enrollments
                    ->orderBy('enrollments.created_at', $order)
                    ->orderBy('users.lastname')
                    ->orderBy('users.firstname');
                break;
            default:
                $enrollments
                    ->orderBy('enrollments.register', $order)
                    ->orderBy('users.lastname')
                    ->orderBy('users.firstname');
        }

        return $enrollments
            ->get();
    }

    /**
     * Get Enrollments By Student
     * @param $student
     * @return mixed
     */
    public function getEnrollmentsByStudent($student)
    {
        return Enrollment::select('*')
            ->where('iduser', '=', $student)
            ->get();
    }

    /**
     * Get Latest Enrollment By Student
     * @param $student
     * @return mixed
     */
    public function getEnrollmentsLatestByStudent($student)
    {
        return Enrollment::select('users.iduser', 'users.firstname', 'users.lastname', 'users.photo', 'groups.idgroup', 'groups.name AS group', 'grades.name AS grade', 'enrollments.scholarship', 'users.idgender')
            ->join('users', function ($join) {
                $join
                    ->on('users.iduser', '=', 'enrollments.iduser');
            })
            ->join('groups', function ($join) {
                $join
                    ->on('groups.idgroup', '=', 'enrollments.idgroup');
            })
            ->join('grades', function ($join) {
                $join
                    ->on('grades.idgrade', '=', 'groups.idgrade');
            })
            ->where('users.iduser', '=', $student)
            ->where('groups.idgroup', '=', DB::raw("(SELECT max(idgroup) FROM enrollments WHERE iduser = $student)"))
            ->first();
    }

    /**
     * Get Latest Enrollment By Student
     * @param $student
     * @return mixed
     */
    public static function getEnrollmentLatest($student)
    {
        return Enrollment::select(DB::raw('max(idgroup) AS "group"'))
            ->where('iduser', '=', $student)
            ->first();

    }

    /**
     * Get Enrollments By Student With Cost
     * @param $student
     * @param $year
     * @param $type
     * @return mixed
     */
    public function getEnrollmentsLatestByStudentWithCost($student, $year, $type)
    {
        $enrollment = Enrollment::select('users.iduser', 'users.firstname', 'users.lastname', 'groups.name AS group', 'grades.name AS grade', 'enrollments.scholarship', 'users.idgender', 'costs.*')
            ->join('users', function ($join) {
                $join
                    ->on('users.iduser', '=', 'enrollments.iduser');
            })
            ->join('groups', function ($join) {
                $join
                    ->on('groups.idgroup', '=', 'enrollments.idgroup');
            })
            ->join('grades', function ($join) {
                $join
                    ->on('grades.idgrade', '=', 'groups.idgrade');
            })
            ->join('costs', function ($join) {
                $join
                    ->on('costs.idgrade', '=', 'grades.idgrade');
            })
            ->where('users.iduser', '=', $student)
            ->where('groups.idgroup', '=', DB::raw("(SELECT max(idgroup) FROM enrollments WHERE iduser = $student)"));
        if ($type == 1) {
            $enrollment
                ->whereIn('enrollments.idstatusschooltype', Statusschooltype::STATUS_PREENROLLMENT);
        } else {
            $enrollment
                ->whereIn('enrollments.idstatusschooltype', Statusschooltype::STATUS_ACTIVE);
        }
        return $enrollment
            ->where('costs.idyear', '=', $year)
            ->first();
    }

    /**
     * @param $year
     * @param $period
     * @param $group
     * @param $subject
     * @param $nivel
     * @return mixed
     */
    public function getEnrollmentsWithGrades($year, $period, $group, $subject, $nivel)
    {
        return Enrollment::select('enrollments.iduser', DB::raw('ROUND(SUM(monitorings.average),2) AS rating'), 'inclusion')
            ->join(DB::raw("(SELECT
                        monitorings.idyear AS idyear,
                        monitorings.idperiod,
                        monitorings.idgroup,
                        monitorings.idsubject,
                        monitorings.idnivel,
                        monitorings.iduser,
                        ROUND(AVG(monitorings.`rating`) * monitoringcategorybyyears.percent,2) AS average
                    FROM
                        monitorings
                    INNER JOIN
                        monitoringtypes ON monitoringtypes.idmonitoringtype = monitorings.idmonitoringtype
                    INNER JOIN
                        monitoringcategories ON monitoringcategories.idmonitoringcategory = monitoringtypes.idmonitoringcategory
                    INNER JOIN
                        monitoringcategorybyyears ON monitoringcategorybyyears.idmonitoringcategory = monitoringcategories.idmonitoringcategory
                    WHERE
                        monitoringcategorybyyears.idyear = monitorings.idyear AND
                        monitoringcategorybyyears.idsubject = monitorings.idsubject AND
                        monitorings.idyear = $year AND
                        monitorings.idperiod = $period AND
                        monitorings.idgroup = $group AND
                        monitorings.idsubject = $subject AND
                        monitorings.idnivel = $nivel
                    GROUP BY monitorings.idyear, monitorings.idperiod , monitorings.idgroup , monitorings.idsubject , monitorings.idnivel , monitorings.iduser , monitoringtypes.idmonitoringcategory
                    ORDER BY monitorings.iduser, monitoringtypes.idmonitoringcategory) monitorings"), function ($join) {
                $join
                    ->on('monitorings.iduser', '=', 'enrollments.iduser');
            })
            ->whereRaw('enrollments.idyear = monitorings.idyear')
            ->whereRaw('enrollments.idgroup = monitorings.idgroup')
            ->where("enrollments.idyear", "=", $year)
            ->whereIn('enrollments.idstatusschooltype', [1, 5, 6, 11, 12])
            ->groupBy("monitorings.idyear", "monitorings.idperiod", "monitorings.idgroup", "monitorings.idsubject", "monitorings.idnivel", "enrollments.iduser")
            ->get();
    }

    /**
     * @param $year
     * @param $period
     * @param $group
     * @param $subject
     * @param $nivel
     * @param int $category
     * @return mixed
     */
    public function getEnrollmentsWithData($year, $period, $group, $subject, $nivel, $category = 13)
    {
        return Enrollment::select('users.iduser', 'users.firstname', 'users.lastname', 'users.photo', 'enrollments.idstatusschooltype AS status', 'users.idgender AS gender', 'birth', DB::raw('-0 AS grade'), 'inclusion')
            ->join('users', function ($join) {
                $join
                    ->on('enrollments.iduser', '=', 'users.iduser');
            })
            ->with(['attendances_absent' => function ($query) use ($year, $period, $group, $subject, $nivel) {
                $query
                    ->select('attendances.iduser', DB::raw('SUM(attendances.attendance) AS amount'))
                    ->where('idyear', $year)
                    ->where('idperiod', $period)
                    ->where('idgroup', $group)
                    ->where('idsubject', $subject)
                    ->where('idnivel', $nivel)
                    ->where('type', 'Absent')
                    ->groupBy('attendances.iduser');
            }])
            ->with(['attendances_tardy' => function ($query) use ($year, $period, $group, $subject, $nivel) {
                $query
                    ->select('attendances.iduser', DB::raw('SUM(attendances.attendance) AS amount'))
                    ->where('idyear', $year)
                    ->where('idperiod', $period)
                    ->where('idgroup', $group)
                    ->where('idsubject', $subject)
                    ->where('idnivel', $nivel)
                    ->where('type', 'Tardy')
                    ->groupBy('attendances.iduser');
            }])
            ->where('enrollments.idyear', '=', $year)
            ->where('enrollments.idgroup', '=', $group)
            ->where('users.idcategory', '=', $category)
            ->whereIn('enrollments.idstatusschooltype', [1, 5, 6, 11, 12])
            ->get();
    }

    /**
     * @param $year
     * @param $period
     * @param $group
     * @param $subject
     * @param $nivel
     * @param int $category
     * @return mixed
     */
    public function getEnrollmentsWithPartial($year, $period, $group, $subject, $nivel, $category = 13)
    {
        return Enrollment::select('users.iduser', 'users.firstname', 'users.lastname', 'users.photo', 'enrollments.idstatusschooltype AS status', 'users.idgender AS gender', 'birth', DB::raw('-0 AS grade'), 'inclusion')
            ->join('users', function ($join) {
                $join
                    ->on('enrollments.iduser', '=', 'users.iduser');
            })
            ->with(['partials' => function ($query) use ($year, $period, $group, $subject, $nivel) {
                $query
                    ->where('idyear', $year)
                    ->where('idperiod', $period)
                    ->where('idgroup', $group)
                    ->where('idsubject', $subject)
                    ->where('idnivel', $nivel);
            }])
            ->where('enrollments.idyear', '=', $year)
            ->where('enrollments.idgroup', '=', $group)
            ->where('users.idcategory', '=', $category)
            ->whereIn('enrollments.idstatusschooltype', [1, 5, 6, 11, 12])
            ->get();
    }

    /**
     * GEt Enrollments With Descriptive Reports
     * @param $year
     * @param $period
     * @param $group
     * @param $subject
     * @param $nivel
     * @param int $category
     * @return mixed
     */
    public function getEnrollmentsWithDescriptivereport($year, $period, $group, $subject, $nivel, $category = 13)
    {
        return Enrollment::select('users.iduser', 'users.firstname', 'users.lastname', 'users.photo', 'enrollments.idstatusschooltype AS status', 'users.idgender AS gender', 'birth', DB::raw('-0 AS grade'), 'inclusion')
            ->join('users', function ($join) {
                $join
                    ->on('enrollments.iduser', '=', 'users.iduser');
            })
            ->with(['descriptivereports' => function ($query) use ($year, $period, $group, $subject, $nivel) {
                $query
                    ->where('idyear', $year)
                    ->where('idperiod', $period)
                    ->where('idgroup', $group)
                    ->where('idsubject', $subject)
                    ->where('idnivel', $nivel);
            }])
            ->where('enrollments.idyear', '=', $year)
            ->where('enrollments.idgroup', '=', $group)
            ->where('users.idcategory', '=', $category)
            ->whereIn('enrollments.idstatusschooltype', [1, 5, 6, 11, 12])
            ->get();
    }

    /**
     * @param $year
     * @param $period
     * @param $group
     * @param $subject
     * @param $nivel
     * @param $date
     * @param int $category
     * @return mixed
     */
    public function getEnrollmentsWithAttendance($year, $period, $group, $subject, $nivel, $date, $category = 13)
    {
        return Enrollment::select('users.iduser', 'users.firstname', 'users.lastname', 'users.photo', 'enrollments.idstatusschooltype AS status', 'users.idgender AS gender', 'birth', DB::raw('"Present" AS attendance'), DB::raw('1 AS count'), DB::raw('"false" AS saved'), 'inclusion')
            ->join('users', function ($join) {
                $join
                    ->on('enrollments.iduser', '=', 'users.iduser');
            })
            ->with(['attendances' => function ($query) use ($year, $period, $group, $subject, $nivel) {
                $query
                    ->select('attendances.iduser', 'attendances.type', DB::raw('SUM(attendances.attendance) AS amount'))
                    ->where('idyear', $year)
                    ->where('idperiod', $period)
                    ->where('idgroup', $group)
                    ->where('idsubject', $subject)
                    ->where('idnivel', $nivel)
                    ->groupBy('attendances.iduser')
                    ->groupBy('attendances.type');
            }])
            ->with(['attendancetoday' => function ($query) use ($year, $period, $group, $subject, $nivel, $date) {
                $query
                    ->where('idyear', $year)
                    ->where('idperiod', $period)
                    ->where('idgroup', $group)
                    ->where('idsubject', $subject)
                    ->where('idnivel', $nivel)
                    ->where('date', date('Y-m-d', strtotime($date)));
            }])
            ->where('enrollments.idyear', '=', $year)
            ->where('enrollments.idgroup', '=', $group)
            ->where('users.idcategory', '=', $category)
            ->whereIn('enrollments.idstatusschooltype', [1, 5, 6, 11, 12])
            ->orderBy('users.lastname', 'ASC')
            ->orderBy('users.firstname', 'ASC')
            ->get();
    }

    public function getEnrollmentsWithObservers($year, $group = 0, $category = [13], $types = [1, 5, 6, 11, 12])
    {
        return Enrollment::select('users.iduser', 'users.firstname', 'users.lastname', 'users.photo', 'enrollments.idstatusschooltype AS status', 'users.idgender AS gender', 'birth', 'inclusion')
            ->join('users', function ($join) {
                $join
                    ->on('enrollments.iduser', '=', 'users.iduser');
            })
            ->with(['observers' => function ($query) use ($year, $group) {
                $query
                    ->where('idyear', $year)
                    ->where('idgroup', $group);
            }])
            ->where('enrollments.idyear', '=', $year)
            ->where('enrollments.idgroup', '=', $group)
            ->whereIn('users.idcategory', $category)
            ->whereIn('enrollments.idstatusschooltype', $types)
            ->orderBy('enrollments.idgroup')
            ->orderBy('users.lastname')
            ->orderBy('users.firstname')
            ->get();
    }

    /**
     * Get Enrollments By Status
     * @param $year
     * @param $status
     */
    public function getEnrollmentsByStatus($year, $status)
    {
        $enrollments = Enrollment::select(DB::raw("COUNT('*') AS amount"))
            ->where('idyear', '=', $year);
        switch ($status) {
            case 'actives':
                $enrollments->whereIn('idstatusschooltype', [1]);
                break;
            case 'retired':
                $enrollments->whereIn('idstatusschooltype', [4]);
                break;
            case 'internship':
                $enrollments->whereIn('idstatusschooltype', [6]);
                break;
            case 'assistant':
                $enrollments->whereIn('idstatusschooltype', [11]);
                break;
            case 'pending':
                $enrollments->whereIn('idstatusschooltype', [12]);
                break;
            case 'psychology':
                $enrollments->whereIn('idstatusschooltype', [13]);
                break;
        }
        return $enrollments->first();
    }

    /**
     * @param int $year
     * @param int $group
     * @return mixed
     */
    public function getEnrollmentAttendacessList($year, $group = null)
    {
        $enrollments = Enrollment::select(DB::raw("CONCAT_WS(CONVERT(' ' USING latin1),users.lastname,users.firstname) AS Student"), 'groups.name AS group')
            ->join('users', function ($join) {
                $join
                    ->on('enrollments.iduser', '=', 'users.iduser');
            })
            ->join('groups', function ($join) {
                $join
                    ->on('enrollments.idgroup', '=', 'groups.idgroup');
            })
            ->where('enrollments.idyear', '=', $year)
            ->where('groups.idgroup', '=', $group)
            ->whereIn('enrollments.idstatusschooltype', [1, 6, 11, 13])
            ->orderBy('enrollments.idgroup')
            ->orderBy('Student');
        return $enrollments
            ->get();
    }
}