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
        //return User::select('*')->remember('1440', 'users');
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
            'celular_confirmed' => 1,
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
            'email_confirmed' => 1,
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
            'celular_confirmed' => 1,
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
            'email_confirmed' => 1,
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
    public function getallstudents($year = null,$showactives= false)
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
                $users->whereIn('enrollments.idstatusschooltype', [1,6,11,13]);
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
    public function getStudentsPendigsByMonitorings($year,$period,$group = null,$area = null ,$teacher =null,$subjectNotIn = [54],$statusNotIn = [4,7,8,9,10])    {
        $select = User::select(
            'contractssummarized.idyear',
            'users.iduser AS User',
            'groups.idgroup','groups.name AS Groups',
             DB::raw("CONCAT_WS(CONVERT(' ' USING latin1),users.lastname,users.firstname) AS Student"),
            'subjects.idsubject','subjects.name AS Subject',
            'monitoringsqualified.rating',
            'areas.idarea',
            'areas.name AS Area',
            'nivelattendances','idteachersnivels',
            'teachers',
            'nivels',
            'users.photo',
            'statusschooltypes.idstatusschooltype','statusschooltypes.name AS Status'
            )
            ->join('enrollments', function ($join) { $join->on('enrollments.iduser', '=', 'users.iduser'); })
            ->join('groups', function ($join) {  $join->on('groups.idgroup', '=', 'enrollments.idgroup');})
            ->join('statusschooltypes', function ($join) { $join->on('statusschooltypes.idstatusschooltype', '=', 'enrollments.idstatusschooltype'); })
            ->join(DB::raw("(SELECT
                  idyear, idgroup, idperiod, contracts.idsubject,
                  GROUP_CONCAT(CAST(contracts.iduser AS CHAR)) AS idusers,
                  GROUP_CONCAT(CONCAT_WS(CONVERT(' ' USING latin1),users.lastname, users.firstname)) AS teachers,
                  CONCAT('[',GROUP_CONCAT(CONCAT('{','teacher : \"',CONCAT_WS(CONVERT(' ' USING latin1),SUBSTRING_INDEX(users.lastname, ' ', 1), users.firstname),'\"  ,nivel :\"',nivels.name,'\",photo :\"',users.photo,'\"}')),']') AS 'nivels',
                  CONCAT('[',GROUP_CONCAT(CONCAT('{','idnivel : ',nivels.idnivel,'  ,idteacher :',users.iduser,'}')),']') AS 'idteachersnivels'
               FROM contracts
                INNER JOIN users ON users.iduser = contracts.iduser
                INNER JOIN nivels ON nivels.idnivel = contracts.idnivel
               WHERE idyear = ".$year." AND idperiod = ".$period." GROUP BY idyear,idperiod,idgroup,contracts.idsubject) AS contractssummarized"), function ($join) {
                $join
                    ->on('contractssummarized.idyear', '=', 'enrollments.idyear')
                    ->on('contractssummarized.idgroup', '=', 'enrollments.idgroup')
                    ;
            })
            ->leftJoin(DB::raw('(SELECT idyear, idperiod, idgroup, idsubject, idnivel, iduser, rating FROM monitorings
                 WHERE idyear = '.$year.' AND idperiod = '.$period.' GROUP BY idyear,idperiod,idgroup,idsubject,iduser) AS monitoringsqualified'), function ($join) {
                $join
                    ->on('monitoringsqualified.idyear', '=', 'contractssummarized.idyear')
                    ->on('monitoringsqualified.idperiod', '=', 'contractssummarized.idperiod')
                    ->on('monitoringsqualified.idgroup', '=', 'contractssummarized.idgroup')
                    ->on('monitoringsqualified.idsubject', '=', 'contractssummarized.idsubject')
                    ->on('monitoringsqualified.iduser', '=', 'enrollments.iduser')
                    ;
            })
            ->leftJoin(DB::raw("(SELECT  idyear, idperiod, idgroup, idsubject, idnivel, iduser,CONCAT('[',GROUP_CONCAT(CONCAT('{','idnivel : \"',idnivel,'\"  ,amount :',total,'}')),']') AS 'nivelattendances'
                                FROM (SELECT  idyear, idperiod, idgroup, idsubject, idnivel, iduser, SUM(attendances.attendance) as total FROM attendances 
                                WHERE idyear = ".$year." AND idperiod = ".$period." GROUP BY idyear,idperiod,idgroup,iduser,idsubject,idnivel) AS totalattendances 
                        GROUP BY idyear,idperiod,idgroup,iduser,idsubject) AS attendancesbynivels"), function ($join) {
                $join
                    ->on('attendancesbynivels.idyear', '=', 'contractssummarized.idyear')
                    ->on('attendancesbynivels.idperiod', '=', 'contractssummarized.idperiod')
                    ->on('attendancesbynivels.idgroup', '=', 'contractssummarized.idgroup')
                    ->on('attendancesbynivels.idsubject', '=', 'contractssummarized.idsubject')
                    ->on('attendancesbynivels.iduser', '=', 'enrollments.iduser')
                    ;
            })
            ->join('subjects', function ($join) { $join->on('subjects.idsubject', '=', 'contractssummarized.idsubject');})
            ->join('areas', function ($join) { $join->on('areas.idarea', '=', 'subjects.idarea');})
            ->join('academics', function ($join) {
                $join
                    ->on('academics.idyear', '=', 'contractssummarized.idyear')
                    ->on('academics.idperiod', '=', 'contractssummarized.idperiod');
            })
            ->where('enrollments.idyear', '=', $year)
            ->whereNotIn('enrollments.idstatusschooltype', $statusNotIn);
            if($group !== null) {
                $select->where('enrollments.idgroup', '=', $group);
            }else{
                $select->where('enrollments.idgroup', '>', 10);
            }
            $select->whereRaw('TO_DAYS(academics.print) - TO_DAYS(enrollments.register) >= 30')
            ->whereNotIn('contractssummarized.idsubject', $subjectNotIn)
            ->whereNull('monitoringsqualified.rating');
            if ($area !== null) {
                $select->where('areas.idarea', '=', $area);
            }
            if ($teacher !== null) {
                $select->where('idteachersnivels', 'like', '%'.$teacher.'%');
            }
            $select->orderBy('enrollments.idgroup')
            ->orderBy('Student');
        /*$resultado['Parametros'] = $select->getBindings();
        $query = str_replace(array('%', '?'), array('%%', '%s'), $select->toSql());
        $query = vsprintf($query, $select->getBindings());
        $resultado['Consulta'] = $query;
            dd(  $resultado);*/
           return $select->get();
    }
}