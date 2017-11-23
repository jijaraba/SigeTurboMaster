<?php

namespace SigeTurbo\Repositories\Userfamily;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use PDO;
use SigeTurbo\Category;
use SigeTurbo\Repositories\Year\YearRepository;
use SigeTurbo\Userfamily;

class UserfamilyRepository implements UserfamilyRepositoryInterface
{

    /**
     * Return all values
     * @return mixed
     */
    public function all()
    {
        return Userfamily::all();
    }

    /**
     * Find in Databases
     * @param $iduserfamily
     * @return mixed
     */
    public function find($iduserfamily)
    {
        return Userfamily::find($iduserfamily);
    }


    /**
     * Save Userfamily
     * @param $data
     * @return static
     */
    public function store($data)
    {
        return Userfamily::create(array(
            'iduser' => $data['user'],
            'idfamily' => $data['family']
        ));
    }

    /**
     * Find in Databases
     * @param $family
     * @param $user
     * @return mixed
     */
    public static function findByFamily($family, $user)
    {
        return Userfamily::select("users.*", 'categories.name AS category')
            ->join('users', function ($join) {
                $join->on('users.iduser', '=', 'userfamilies.iduser');
            })
            ->join('categories', function ($join) {
                $join->on('categories.idcategory', '=', 'users.idcategory');
            })
            ->where("userfamilies.idfamily", "=", $family)
            ->whereNotIn("users.iduser", [$user])
            ->get();
    }


    /**
     * Find in Databases
     * @param $user
     * @return mixed
     */
    public function getMembersFamilyByUser($user)
    {
        return Userfamily::select("users.*", DB::raw('CONCAT_WS(CONVERT(" " USING latin1),users.lastname,users.firstname) AS fullname'))
            ->join('users', function ($join) {
                $join->on('users.iduser', '=', 'userfamilies.iduser');
            })
            ->join('categories', function ($join) {
                $join->on('categories.idcategory', '=', 'users.idcategory');
            })
            ->whereRaw("userfamilies.idfamily IN (SELECT idfamily FROM userfamilies WHERE userfamilies.iduser = $user)")
            ->where('categories.idcategory', '=', Category::STUDENT)
            ->get();
    }

    /**
     * Get Users By Family
     * @param $data
     * @return mixed
     */
    public function getUsersByFamily($data)
    {

        $user = $data['user'];
        $category = null;
        if (isset($data['category']) && $data['category'] != 'null') {
            $type_search = (getUser()->role_selected === 'Student') ? 'iduser' : 'idfamily';
            $category = $data['category'];

            return DB::select("SELECT
            DISTINCT users.iduser,
            users.firstname,
            users.lastname,
            users.photo,
            users.email,
            users.idcategory,
            categories.name AS 'category',
            userfamilies.idfamily,
            families.name AS family
          FROM
            userfamilies
            INNER JOIN users ON users.iduser = userfamilies.iduser
            INNER JOIN families ON families.idfamily = userfamilies.idfamily
            INNER JOIN categories ON categories.idcategory = users.idcategory
          WHERE
            userfamilies." . $type_search . " IN (SELECT " . $type_search . " FROM userfamilies WHERE userfamilies.iduser = $user)
            AND users.idstatus IN (1 , 2, 3, 5, 6, 7, 11)
            AND users.idcategory = $category
          GROUP BY users.iduser, userfamilies.idfamily");

        } else {
            return DB::select("SELECT
            DISTINCT users.iduser,
            users.firstname,
            users.lastname,
            users.photo,
            users.email,
            users.idcategory,
            categories.name AS 'category',
            userfamilies.idfamily,
            families.name AS family
          FROM
            userfamilies
            INNER JOIN users ON users.iduser = userfamilies.iduser
            INNER JOIN families ON families.idfamily = userfamilies.idfamily
            INNER JOIN categories ON categories.idcategory = users.idcategory
          WHERE
            userfamilies.idfamily IN (SELECT idfamily FROM userfamilies WHERE userfamilies.iduser = $user)
          GROUP BY users.iduser, userfamilies.idfamily");
        }

    }


    /**
     * Get Families
     * @param array $group
     * @param array $family
     * @param array $category
     * @return mixed
     */
    public function getFamilies($family = [], $category = [], $group = [])
    {

        return Userfamily::select('families.idfamily', 'families.name AS family', 'categories.idcategory AS categoryID', 'categories.name AS category', 'users.iduser', DB::raw('CONCAT_WS(CONVERT(" " USING LATIN1), firstname, lastname) AS fullname'), 'users.firstname', 'users.lastname', 'users.email')
            ->join('users', function ($join) {
                $join->on('users.iduser', '=', 'userfamilies.iduser');
            })
            ->join('families', function ($join) {
                $join->on('families.idfamily', '=', 'userfamilies.idfamily');
            })
            ->join('categories', function ($join) {
                $join->on('categories.idcategory', '=', 'users.idcategory');
            })
            ->whereIn(
            /**
             * @param $query
             */
                'userfamilies.idfamily', function ($query) use ($group, $family) {
                $query
                    ->select('userfamilies.idfamily')
                    ->from('users')
                    ->join('enrollments', function ($join) {
                        $join->on('enrollments.iduser', '=', 'users.iduser');
                    })
                    ->join('years', function ($join) {
                        $join->on('years.idyear', '=', 'enrollments.idyear');
                    })
                    ->join('userfamilies', function ($join) {
                        $join->on('userfamilies.iduser', '=', 'enrollments.iduser');
                    })
                    ->join('groups', function ($join) {
                        $join->on('groups.idgroup', '=', 'enrollments.idgroup');
                    })
                    ->where('years.idyear', '=', YearRepository::getCurrentYear()->idyear)
                    ->whereNotIn('enrollments.idstatusschooltype', [4, 10]);
                //Detect Families
                if (count($family) > 0) {
                    $query->whereIn('userfamilies.idfamily', $family);
                }
                //Detect Group
                if (count($group) > 0) {
                    $query->whereIn('enrollments.idgroup', $group);
                }
                $query->get();
            })
            ->whereIn('categories.idcategory', $category)
            ->where('users.email_confirmed', '=', 1)
            ->get();

    }

    /**
     * Get Family Name
     * @param $user
     * @return mixed
     */
    public function getFamilyName($user)
    {
        return Userfamily::select('families.name AS family')
            ->join('families', function ($join) {
                $join->on('families.idfamily', '=', 'userfamilies.idfamily');
            })
            ->where('userfamilies.iduser', '=', $user)
            ->first();
    }

    /**
     * Get Emails By Family
     * @param $year
     * @param $family
     * @return array
     */
    public function getEmailsByFamily($year, $family)
    {
        $data = DB::SELECT("
            SELECT
                families.idfamily,
                families.name AS 'family',
                categories.name AS 'category',
                users.iduser,
                CONCAT_WS(CONVERT( ' ' USING LATIN1), firstname, lastname) AS 'fullname',
                users.firstname,
                users.lastname,
                users.email,
                users.idgender
            FROM
                userfamilies
                INNER JOIN users ON users.iduser = userfamilies.iduser
                INNER JOIN families ON families.idfamily = userfamilies.idfamily
                INNER JOIN categories ON categories.idcategory = users.idcategory
            WHERE
                userfamilies.idfamily IN (
                    SELECT
                        userfamilies.idfamily
                    FROM
                        users
                        INNER JOIN
                        enrollments ON enrollments.iduser = users.iduser
                        INNER JOIN
                        years ON years.idyear = enrollments.idyear
                        INNER JOIN
                        userfamilies ON userfamilies.iduser = enrollments.iduser
                        INNER JOIN
                        groups ON groups.idgroup = enrollments.idgroup
                    WHERE
                        years.idyear IN ($year)
                        AND enrollments.idstatusschooltype NOT IN (4 , 10)
                        AND userfamilies.idfamily IN (?))
                AND users.idstatus NOT IN (4,10)
                AND users.email_confirmed = 1",
            array($family));
        return $data;
    }

    /**
     * Get Family By User
     * @param $user
     * @return mixed
     */
    public function getFamilyByUser($user)
    {
        return Userfamily::select('idfamily AS family')
            ->where('userfamilies.iduser', '=', $user)
            ->first();
    }

}

