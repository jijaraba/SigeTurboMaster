<?php

namespace SigeTurbo\Repositories\User;


use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use SigeTurbo\Category;
use SigeTurbo\User;

class UserRepository implements UserRepositoryInterface
{

    /**
     * Return all values
     * @return mixed
     */
    public function all()
    {
        return Cache::remember('users', 1440, function () {
            return User::all();
        });
    }

    /**
     * Find in Databases
     * @param $iduser
     * @return mixed
     */
    public function find($iduser)
    {
        return User::find($iduser);
    }


    /**
     * Insert User
     * @param $data
     * @return mixed
     */
    public function store($data)
    {
        return User::create(array(
            'iduser' => $data['iduser'],
            'lastname' => $data['lastname'],
            'firstname' => $data['firstname'],
            'idcategory' => $data['idcategory'],
            'idstatus' => $data['idstatus'],
            'idtown' => $data['idtown'],
            'address' => $data['address'],
            'idstratus' => $data['idstratus'],
            'phone' => $data['phone'],
            'celular' => $data['celular'],
            'idethnicgroup' => $data['idethnicgroup'],
            'idmaritalstatus' => $data['idmaritalstatus'],
            'idgender' => $data['idgender'],
            'idreligion' => $data['idreligion'],
            'birth' => $data['birth'],
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
            'email' => $data['email'],
            'email_personal' => $data['email_personal'],
            'api_token' => str_random(60),
            'token' => str_random(70),
            "created_by" => getUser()->iduser,
            'created_at' => Carbon::now(),
        ));
    }

    /**
     * Update User
     * @param $user
     * @param $data
     * @return mixed
     */
    public function update($user, $data)
    {
        //Find user
        $user = User::find($user);
        $user->fill([
            'iduser' => $data['iduser'],
            'lastname' => $data['lastname'],
            'firstname' => $data['firstname'],
            'idcategory' => $data['idcategory'],
            'idstatus' => $data['idstatus'],
            'idtown' => $data['idtown'],
            'address' => $data['address'],
            'idstratus' => $data['idstratus'],
            'phone' => $data['phone'],
            'celular' => $data['celular'],
            'idethnicgroup' => $data['idethnicgroup'],
            'idmaritalstatus' => $data['idmaritalstatus'],
            'idgender' => $data['idgender'],
            'idreligion' => $data['idreligion'],
            'birth' => $data['birth'],
            'email' => $data['email'],
            'email_personal' => $data['email_personal'],
            "updated_by" => getUser()->iduser,
            'updated_at' => Carbon::now()
        ]);
        return $user->save();

    }

    /**
     * Get Latest User
     * @param $count
     * @return mixed
     */
    public function getLatest($count)
    {
        return User::orderBy('created_at', 'DESC')->where('idcategory', '=', Category::STUDENT)->take($count)->get();
    }

    /**
     * Get Students
     * @return mixed
     */
    public function getStudents()
    {
        return User::orderBy('created_at', 'DESC')->where('idcategory', '=', Category::STUDENT)->get();
    }

    /**
     * Get Latest Code
     * @return mixed
     */
    public function getLatestCode()
    {
        return User::select(DB::raw('(MAX(iduser)+1) AS code'))->where('idcategory', '=', Category::STUDENT)->first();
    }

    /**
     * Get All Users By Rol
     * @param $role
     * @return mixed
     */
    public function getUsersByRole($role)
    {
        return User::select('*')
            ->where(DB::raw('SUBSTRING_INDEX(role,\',\',1)'), '=', $role)
            ->get();
    }

    /**
     * Get User By Rol
     * @param $role
     * @return mixed
     */
    public function getUserByRole($role)
    {
        return User::select('*')
            //->whereRaw("SUBSTRING_INDEX(role,',',1)  = '$role'")
            ->whereRaw("role REGEXP (SELECT REPLACE('$role',',','.*|'))")
            ->get();

    }

    /**
     * Get All Users By Roles
     * @param string $roles
     * @return mixed
     */
    public function getUsersByRoles($roles)
    {
        return User::select('*', DB::raw('CONCAT_WS(CONVERT(" " USING latin1),users.lastname,users.firstname) AS fullname'))
            ->where("idstatus", "=", 1)
            ->whereRaw("role REGEXP  (SELECT REPLACE('$roles',',','.*|'))")
            ->orderBy('fullname', 'ASC')
            ->get();
    }

    /**
     * Get All User by Category
     * @param $category
     * @return mixed
     */
    public function getUsersByCategory($category)
    {
        return User::select('*')
            ->where('idcategory', '=', $category)
            ->get();
    }

    /**
     * Get All Users by Categories
     * @param array $categories
     * @return mixed
     */
    public function getUsersByCategories($categories = [])
    {
        return User::select('*')
            ->whereIn('idcategory', $categories)
            ->get();
    }

    /**
     * Get All Users by Datas Defined
     * @param array $categories
     * @return mixed
     */
    public function getUsersByDataDefined($categories = [], $search, $sort = null, $order = 'ASC')
    {
        $users = User::select('users.iduser', 'users.firstname', 'users.lastname', 'users.photo', 'users.idgender AS gender', 'birth', 'categories.name AS category', 'users.idcategory', 'users.idstatus AS status')
            ->join('categories', function ($join) {
                $join
                    ->on('categories.idcategory', '=', 'users.idcategory');
            })
            ->whereIn('users.idcategory', $categories);
        //Search
        if ($search !== null) {
            if (isset($search["code"])) {
                $users
                    ->where('users.iduser', 'LIKE', "%" . $search['code'] . "%");
            }
            if (isset($search["firstname"])) {
                $users
                    ->where('users.firstname', 'LIKE', "%" . $search['firstname'] . "%");
            }
            if (isset($search["lastname"])) {
                $users
                    ->where('users.lastname', 'LIKE', "%" . $search['lastname'] . "%");
            }
            if (isset($search["celular"])) {
                $users
                    ->where('users.celular', 'LIKE', "%" . $search['celular'] . "%");
            }
        }

        //Sort
        switch ($sort) {
            case 'category':
                $users
                    ->orderBy('categories.idcategory', $order)
                    ->orderBy('users.lastname')
                    ->orderBy('users.firstname');
                break;
            default:
                $users
                    ->orderBy('categories.idcategory', $order)
                    ->orderBy('users.lastname', $order)
                    ->orderBy('users.firstname');
        }
        return $users->get();
    }

    /** Get Student by ID With Enrollments
     * @param $user
     * @return mixed
     */
    public function getStudentById($user)
    {
        return User::select("users.*")
            ->where('users.iduser', '=', $user)
            ->with('enrollments')
            ->with('userfamily')
            ->with('identification')
            ->with('schoolinformation')
            ->with('healthinformation')
            ->with('origeninformation')
            ->with('responsibleparent')
            ->with('payments')
            ->first();
    }

    /**
     * Verify Celular
     * @param $celular
     * @return mixed
     */
    public function verifyCelular($celular)
    {
        return User::select('*')
            ->whereCelular($celular)
            ->get();
    }

    /**
     * Verify Email
     * @param $email
     * @return mixed
     */
    public function verifyEmail($email)
    {
        return User::select('*')
            ->whereEmail($email)
            ->get();
    }

    /**
     * Update Celular
     * @param $user
     * @param $data
     * @param $passcode
     * @return mixed
     */
    public function updateCelularPasscode($user, $data, $passcode)
    {
        $user = User::find($user);
        $user->fill([
            'celular_passcode' => $passcode,
            "updated_by" => getUser()->iduser,
            'updated_at' => Carbon::now()
        ]);
        return $user->save();

    }

    /**
     * Update Email
     * @param $user
     * @param $data
     * @param $passcode
     * @return mixed
     */
    public function updateEmailPasscode($user, $data, $passcode)
    {
        $user = User::find($user);
        $user->fill([
            'email_passcode' => $passcode,
            "updated_by" => getUser()->iduser,
            'updated_at' => Carbon::now()
        ]);
        return $user->save();

    }

    /**
     * Save Celular With Passcode
     * @param $user
     * @param $data
     * @return mixed
     */
    public function updateCelularWithPasscode($user, $data)
    {
        $user = User::find($user);
        $user->fill([
            'celular' => $data["celular"],
            'celular_passcode' => null,
            'celular_confirmed' => '1',
            "updated_by" => getUser()->iduser,
            'updated_at' => Carbon::now()
        ]);
        return $user->save();
    }

    /**
     * Save Email With Passcode
     * @param $user
     * @param $data
     * @return mixed
     */
    public function updateEmailWithPasscode($user, $data)
    {
        $user = User::find($user);
        $user->fill([
            'email' => $data["email"],
            'email_passcode' => null,
            'email_confirmed' => '1',
            "updated_by" => getUser()->iduser,
            'updated_at' => Carbon::now()
        ]);
        return $user->save();
    }


    /**
     * Save Celular Certification
     * @param $user
     * @param $data
     * @return mixed
     */
    public function updateCelularCertification($user, $data)
    {
        $user = User::find($user);
        $user->fill([
            'celular' => $data["celular"],
            'celular_passcode' => null,
            'celular_confirmed' => '1',
            "updated_by" => getUser()->iduser,
            'updated_at' => Carbon::now()
        ]);
        return $user->save();
    }


    /**
     * Save Email Certification
     * @param $user
     * @param $data
     * @return mixed
     */
    public function updateEmailCertification($user, $data)
    {
        $user = User::find($user);
        $user->fill([
            'email' => $data["email"],
            'email_passcode' => null,
            'email_confirmed' => '1',
            "updated_by" => getUser()->iduser,
            'updated_at' => Carbon::now()
        ]);
        return $user->save();
    }

    /**
     * Get Personal Academic
     * @return mixed
     */
    public function getPersonalAcademic()
    {
        return User::select('users.iduser', 'users.firstname', 'users.lastname', 'users.photo')
            ->whereIn('iduser', function ($query) {
                $query
                    ->select(DB::raw("iduser"))
                    ->from('contracts')
                    ->groupBy('iduser')
                    ->get();
            })
            ->orWhereIn('idcategory', [2, 9, 6, 10, 17])
            ->get();
    }

    /**
     * Get All Students
     * @return mixed
     */
    public function getallstudents($year = null, $showactives = false)
    {
        $users = User::select('users.iduser', 'firstname', 'photo', 'lastname', DB::raw('MAX(idyear) AS Lastyear'), DB::raw('MAX(idgroup) AS Lastgroup'))
            ->join('enrollments', function ($join) {
                $join
                    ->on('enrollments.iduser', '=', 'users.iduser');
            });
        if ($year !== null) {
            $users->where('enrollments.idyear', '=', $year);
        }
        if ($showactives !== false) {
            $users->whereIn('enrollments.idstatusschooltype', [1, 6, 11, 13]);
        }
        return $users->where('idcategory', '=', 13)
            ->groupBy('users.iduser')
            ->get();
    }

    /**
     * Get Monitorings In Current Week By Teacher
     * @param $year
     * @param $period
     * @param $group
     * @param $area
     * @param $teacher
     * @param $subjectNotIn
     * @param $statusNotIn
     * @return mixed
     */
    public function getStudentsPendingByMonitorings($year, $period, $group = null, $area = null, $teacher = null, $subjectNotIn = [54], $statusNotIn = [4, 7, 8, 9, 10])
    {
        $select = User::select(
            'contractssummarized.idyear',
            'users.iduser AS User',
            'groups.idgroup', 'groups.name AS Groups',
            DB::raw("CONCAT_WS(CONVERT(' ' USING latin1),users.lastname,users.firstname) AS Student"),
            'subjects.idsubject', 'subjects.name AS Subject',
            'monitoringsqualified.rating',
            'areas.idarea',
            'areas.name AS Area',
            'nivelattendances', 'idteachersnivels',
            'teachers',
            'nivels',
            'users.photo',
            'statusschooltypes.idstatusschooltype', 'statusschooltypes.name AS Status'
        )
            ->join('enrollments', function ($join) {
                $join->on('enrollments.iduser', '=', 'users.iduser');
            })
            ->join('groups', function ($join) {
                $join->on('groups.idgroup', '=', 'enrollments.idgroup');
            })
            ->join('statusschooltypes', function ($join) {
                $join->on('statusschooltypes.idstatusschooltype', '=', 'enrollments.idstatusschooltype');
            })
            ->join(DB::raw("(SELECT
                  idyear, idgroup, idperiod, contracts.idsubject,
                  GROUP_CONCAT(CAST(contracts.iduser AS CHAR)) AS idusers,
                  GROUP_CONCAT(CONCAT_WS(CONVERT(' ' USING latin1),users.lastname, users.firstname)) AS teachers,
                  CONCAT('[',GROUP_CONCAT(CONCAT('{','teacher : \"',CONCAT_WS(CONVERT(' ' USING latin1),SUBSTRING_INDEX(users.lastname, ' ', 1), users.firstname),'\"  ,nivel :\"',nivels.name,'\",photo :\"',users.photo,'\"}')),']') AS 'nivels',
                  CONCAT('[',GROUP_CONCAT(CONCAT('{','idnivel : ',nivels.idnivel,'  ,idteacher :',users.iduser,'}')),']') AS 'idteachersnivels'
               FROM contracts
                INNER JOIN users ON users.iduser = contracts.iduser
                INNER JOIN nivels ON nivels.idnivel = contracts.idnivel
               WHERE idyear = " . $year . " AND idperiod = " . $period . " GROUP BY idyear,idperiod,idgroup,contracts.idsubject) AS contractssummarized"), function ($join) {
                $join
                    ->on('contractssummarized.idyear', '=', 'enrollments.idyear')
                    ->on('contractssummarized.idgroup', '=', 'enrollments.idgroup');
            })
            ->leftJoin(DB::raw('(SELECT idyear, idperiod, idgroup, idsubject, idnivel, iduser, rating FROM monitorings
                 WHERE idyear = ' . $year . ' AND idperiod = ' . $period . ' GROUP BY idyear,idperiod,idgroup,idsubject,iduser) AS monitoringsqualified'), function ($join) {
                $join
                    ->on('monitoringsqualified.idyear', '=', 'contractssummarized.idyear')
                    ->on('monitoringsqualified.idperiod', '=', 'contractssummarized.idperiod')
                    ->on('monitoringsqualified.idgroup', '=', 'contractssummarized.idgroup')
                    ->on('monitoringsqualified.idsubject', '=', 'contractssummarized.idsubject')
                    ->on('monitoringsqualified.iduser', '=', 'enrollments.iduser');
            })
            ->leftJoin(DB::raw("(SELECT  idyear, idperiod, idgroup, idsubject, idnivel, iduser,CONCAT('[',GROUP_CONCAT(CONCAT('{','idnivel : \"',idnivel,'\"  ,amount :',total,'}')),']') AS 'nivelattendances'
                                FROM (SELECT  idyear, idperiod, idgroup, idsubject, idnivel, iduser, SUM(attendances.attendance) as total FROM attendances 
                                WHERE idyear = " . $year . " AND idperiod = " . $period . " GROUP BY idyear,idperiod,idgroup,iduser,idsubject,idnivel) AS totalattendances 
                        GROUP BY idyear,idperiod,idgroup,iduser,idsubject) AS attendancesbynivels"), function ($join) {
                $join
                    ->on('attendancesbynivels.idyear', '=', 'contractssummarized.idyear')
                    ->on('attendancesbynivels.idperiod', '=', 'contractssummarized.idperiod')
                    ->on('attendancesbynivels.idgroup', '=', 'contractssummarized.idgroup')
                    ->on('attendancesbynivels.idsubject', '=', 'contractssummarized.idsubject')
                    ->on('attendancesbynivels.iduser', '=', 'enrollments.iduser');
            })
            ->join('subjects', function ($join) {
                $join->on('subjects.idsubject', '=', 'contractssummarized.idsubject');
            })
            ->join('areas', function ($join) {
                $join->on('areas.idarea', '=', 'subjects.idarea');
            })
            ->join('academics', function ($join) {
                $join
                    ->on('academics.idyear', '=', 'contractssummarized.idyear')
                    ->on('academics.idperiod', '=', 'contractssummarized.idperiod');
            })
            ->where('enrollments.idyear', '=', $year)
            ->whereNotIn('enrollments.idstatusschooltype', $statusNotIn);
        if ($group !== null) {
            $select->where('enrollments.idgroup', '=', $group);
        } else {
            $select->where('enrollments.idgroup', '>', 10);
        }
        $select->whereRaw('TO_DAYS(academics.print) - TO_DAYS(enrollments.register) >= 30')
            ->whereNotIn('contractssummarized.idsubject', $subjectNotIn)
            ->whereNull('monitoringsqualified.rating');
        if ($area !== null) {
            $select->where('areas.idarea', '=', $area);
        }
        if ($teacher !== null) {
            $select->where('idteachersnivels', 'like', '%' . $teacher . '%');
        }
        $select->orderBy('enrollments.idgroup')
            ->orderBy('Student');
        return $select->get();
    }

    /**
     * Get User By Token
     * @param $token
     * @return mixed
     */
    public function getUserByToken($token)
    {
        return User::select('users.*', 'identifications.ididentificationtype', 'userfamilies.idfamily', 'identifications.identification', 'identifications.expedition', 'healthinformations.idbloodtype', 'categories.name AS member')
            ->join('categories', function ($join) {
                $join->on('categories.idcategory', '=', 'users.idcategory');
            })
            ->leftJoin('identifications', function ($join) {
                $join->on('identifications.iduser', '=', 'users.iduser');
            })
            ->leftJoin('healthinformations', function ($join) {
                $join->on('healthinformations.iduser', '=', 'users.iduser');
            })
            ->leftJoin('userfamilies', function ($join) {
                $join->on('userfamilies.iduser', '=', 'users.iduser');
            })
            ->whereToken($token)
            ->first();
    }

    public function getUserInfo($user)
    {
        return DB::select("
            SELECT 
                users.iduser AS iduser,
                groups.name AS `groups`,
                CONCAT_WS(CONVERT(' ' USING LATIN1),
                        users.lastname,
                        users.firstname) AS 'student_name',
                towns.name AS town,
                users.birth AS student_birth,
                (YEAR(CURRENT_DATE) - YEAR(users.birth)) - (RIGHT(CURRENT_DATE, 5) < RIGHT(users.birth, 5)) AS student_age,
                CASE
                    WHEN identificationtypes.name IS NULL THEN 'No Existe Registro'
                    ELSE identificationtypes.name
                END AS student_identificationtype,
                CASE
                    WHEN identifications.identification IS NULL THEN 'No Existe Registro'
                    ELSE identifications.identification
                END AS identification,
                CASE
                    WHEN identifications.expedition IS NULL THEN 'No Existe REgistro'
                    ELSE identifications.expedition
                END AS student_expedition,
                responsibleparents.responsible AS 'student_responsible',
                CASE
                    WHEN
                        CONCAT_WS(CONVERT( ' ' USING LATIN1),
                                responsibledata.lastname,
                                responsibledata.firstname) = ''
                            AND responsibleparents.responsible IS NULL
                    THEN
                        'NO SE HA ASIGNADO RESPONSABLE ECONOMICO A ESTE ESTUDIANTE'
                    WHEN
                        CONCAT_WS(CONVERT(' ' USING LATIN1),
                                responsibledata.lastname,
                                responsibledata.firstname) = ''
                            AND responsibleparents.responsible IS NOT NULL
                    THEN
                        'ESTA CEDULA NO EXISTE EN LA BASE DE DATOS'
                    ELSE CONCAT_WS(CONVERT( ' ' USING LATIN1),
                            responsibledata.lastname,
                            responsibledata.firstname)
                END AS 'responsible_name',
                mothers.iduser AS 'mother_identification',
                IF(CONCAT_WS(CONVERT(' ' USING LATIN1),
                            mothers.lastname,
                            mothers.firstname) = ''
                        OR CONCAT_WS(CONVERT( ' ' USING LATIN1),
                            mothers.lastname,
                            mothers.firstname) IS NULL,
                    'No Existe Registro',
                    CONCAT_WS(CONVERT( ' ' USING LATIN1),
                            mothers.lastname,
                            mothers.firstname)) AS mother_fullname,
                IF(mothers.phone = ''
                        OR mothers.phone IS NULL,
                    'No existe Registro',
                    mothers.phone) AS 'mother_phone',
                IF(mothers.celular = ''
                        OR mothers.celular IS NULL,
                    'No existe Registro',
                    mothers.celular) AS 'mother_celular',
                IF(mothers.email = ''
                        OR mothers.email IS NULL,
                    'No existe registro',
                    mothers.email) AS 'mother_email',
                IF(CAST(mothers.birth AS CHAR) = ''
                        OR CAST(mothers.birth AS CHAR) IS NULL,
                    'No existe registro',
                    CAST(mothers.birth AS CHAR)) AS 'mother_birth',
                IF(CAST(mothers.birth AS CHAR) = ''
                        OR CAST(mothers.birth AS CHAR) IS NULL,
                    'No existe registro',
                    (YEAR(CURRENT_DATE) - YEAR(mothers.birth)) - (RIGHT(CURRENT_DATE, 5) < RIGHT(mothers.birth, 5))) AS 'mother_age',
                CASE
                    WHEN identificationtypesmother.name IS NULL THEN 'No Existe Registro'
                    ELSE identificationtypesmother.name
                END AS 'mother_identification_type',
                CASE
                    WHEN identificationsmother.identification IS NULL THEN 'No Existe Registro'
                    ELSE identificationsmother.identification
                END AS 'mother_identification',
                CASE
                    WHEN identificationsmother.expedition IS NULL THEN 'No Existe Registro'
                    ELSE identificationsmother.expedition
                END AS 'mother_expedition',
                fathers.iduser AS 'father_identification',
                IF(CONCAT_WS(CONVERT(' ' USING LATIN1),
                            fathers.lastname,
                            fathers.firstname) = ''
                        OR CONCAT_WS(CONVERT( ' ' USING LATIN1),
                            fathers.lastname,
                            fathers.firstname) IS NULL,
                    'No Existe Registro',
                    CONCAT_WS(CONVERT( ' ' USING LATIN1),
                            fathers.lastname,
                            fathers.firstname)) AS father_name,
                IF(fathers.phone = ''
                        OR fathers.phone IS NULL,
                    'No existe registro',
                    fathers.phone) AS 'father_phone',
                IF(fathers.celular = ''
                        OR fathers.celular IS NULL,
                    'No existe registro',
                    fathers.celular) AS 'father_celular',
                IF(fathers.email = ''
                        OR fathers.email IS NULL,
                    'No existe registro',
                    fathers.email) AS 'father_email',
                IF(CAST(fathers.birth AS CHAR) = ''
                        OR CAST(fathers.birth AS CHAR) IS NULL,
                    'No existe registro',
                    CAST(fathers.birth AS CHAR)) AS 'father_birth',
                IF(CAST(fathers.birth AS CHAR) = ''
                        OR CAST(fathers.birth AS CHAR) IS NULL,
                    'No existe registro',
                    (YEAR(CURRENT_DATE) - YEAR(fathers.birth)) - (RIGHT(CURRENT_DATE, 5) < RIGHT(fathers.birth, 5))) AS 'father_age',
                CASE
                    WHEN identificationtypesfather.name IS NULL THEN 'No Existe Registro'
                    ELSE identificationtypesfather.name
                END AS 'father_identification_type',
                CASE
                    WHEN identificationsfather.identification IS NULL THEN 'No Existe Registro'
                    ELSE identificationsfather.identification
                END AS 'father_identification',
                CASE
                    WHEN identificationsfather.expedition IS NULL THEN 'No Existe Registro'
                    ELSE identificationsfather.expedition
                END AS 'father_expedition',
                statusschooltypes.name AS 'status',
                'Medellín' AS city,
                'Sociedad Civil El Nuevo Colegio S.A.' AS school_name
            FROM
                users
                    INNER JOIN
                enrollments ON enrollments.iduser = users.iduser
                    INNER JOIN
                towns ON towns.idtown = users.idtown
                    INNER JOIN
                `groups` ON groups.idgroup = enrollments.idgroup
                    LEFT JOIN
                identifications ON identifications.iduser = users.iduser
                    LEFT JOIN
                identificationtypes ON identifications.ididentificationtype = identificationtypes.ididentificationtype
                    INNER JOIN
                statusschooltypes ON statusschooltypes.idstatusschooltype = enrollments.idstatusschooltype
                    LEFT JOIN
                userfamilies ON users.iduser = userfamilies.iduser
                    LEFT JOIN
                families ON families.idfamily = userfamilies.idfamily
                    LEFT JOIN
                (SELECT 
                    userfamilies.idfamily,
                        ANY_VALUE(users.iduser) AS iduser,
                        IF(SUM(IF(users.idgender = 1, users.iduser, 0)) = 0, NULL, SUM(IF(users.idgender = 1, users.iduser, 0))) AS father,
                        IF(SUM(IF(users.idgender = 2, users.iduser, 0)) = 0, NULL, SUM(IF(users.idgender = 2, users.iduser, 0))) AS mother
                FROM
                    userfamilies
                INNER JOIN users ON users.iduser = userfamilies.iduser
                WHERE
                    users.idcategory IN (27 , 28)
                        OR userfamilies.idfamily IN (SELECT 
                            idfamily
                        FROM
                            userfamilies
                        WHERE
                            userfamilies.iduser IN (43578652 , 98549388, 43746806, 63494412, 43757560, 43826243, 52892811, 43727769, 43870654, 42683099, 3507641, 1019032009, 43092198))
                        AND users.idcategory <> 13
                GROUP BY userfamilies.idfamily) AS whithparents ON whithparents.idfamily = userfamilies.idfamily
                    LEFT JOIN
                users AS mothers ON mothers.iduser = whithparents.Mother
                    LEFT JOIN
                users AS fathers ON fathers.iduser = whithparents.father
                    LEFT JOIN
                identifications AS identificationsmother ON identificationsmother.iduser = mothers.iduser
                    LEFT JOIN
                identifications AS identificationsfather ON identificationsfather.iduser = fathers.iduser
                    LEFT JOIN
                identificationtypes AS identificationtypesmother ON identificationsmother.ididentificationtype = identificationtypesmother.ididentificationtype
                    LEFT JOIN
                identificationtypes AS identificationtypesfather ON identificationsfather.ididentificationtype = identificationtypesfather.ididentificationtype
                    LEFT JOIN
                responsibleparents ON responsibleparents.iduser = users.iduser
                    LEFT JOIN
                users AS responsibledata ON responsibleparents.responsible = responsibledata.iduser
            WHERE
                enrollments.idyear = 2017
                    AND enrollments.idstatusschooltype IN (1 , 6, 11, 13)
                    AND enrollments.iduser = $user
            ORDER BY groups.idgroup , student_name LIMIT 1;
        ");
    }

}


