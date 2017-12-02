<?php

namespace SigeTurbo\Monitorings;

use Illuminate\Support\Facades\DB;

class Monitorings
{

    public static function getMonitoringsByUser($iduser)
    {
        $data = (array)DB::SELECT('
			SELECT
				monitorings.idyear,
				monitorings.idperiod,
				groups.name as "group",
				groups.idgroup,
				users.iduser,
				CONCAT_WS(CONVERT(" " USING latin1),lastname,firstname) AS student,
				subjects.idsubject as idsubject,
				subjects.name as subject,
				nivels.name as nivel,
				monitoringtypes.name as monitoring,
				rating,
				CONCAT(adddate(CURDATE(), INTERVAL 1-DAYOFWEEK(CURDATE()) DAY)," - ",adddate(CURDATE(), INTERVAL 7-DAYOFWEEK(CURDATE()) DAY)) as RangeOfWeek
			FROM
				monitorings
				INNER JOIN users ON users.iduser = monitorings.iduser
				INNER JOIN groups ON groups.idgroup = monitorings.idgroup
				INNER JOIN subjects ON subjects.idsubject = monitorings.idsubject
				INNER JOIN nivels ON nivels.idnivel= monitorings.idnivel
				INNER JOIN monitoringtypes ON monitoringtypes.idmonitoringtype= monitorings.idmonitoringtype
			WHERE
				users.iduser = ? AND
				monitorings.created_at BETWEEN adddate(CURDATE(), INTERVAL 1-DAYOFWEEK(CURDATE()) DAY) AND adddate(CURDATE(), INTERVAL 7-DAYOFWEEK(CURDATE()) DAY)
			ORDER BY
				groups.idgroup,
				student,subjects.idsubject,nivels.idnivel,monitoringtypes.name',
            array($iduser));
        return $data;
    }

    public static function getMonitoringsInCurrentWeek()
    {
        $data = (array)DB::SELECT("
          SELECT
                users.iduser,
                groups.name AS 'group',
                CONCAT_WS(CONVERT(' ' USING LATIN1),
                    firstname,
                    lastname) AS student,
                COUNT(*) AS amount,
                CONCAT(ADDDATE(CURDATE(),
                        INTERVAL 1 - DAYOFWEEK(CURDATE()) DAY),
                    ' - ',
                    ADDDATE(CURDATE(),
                        INTERVAL 7 - DAYOFWEEK(CURDATE()) DAY)) AS RangeOfWeek,
                families.name AS family,
                families.idfamily,
                users.idgender
            FROM
                monitorings
                INNER JOIN
                users ON users.iduser = monitorings.iduser
                INNER JOIN
                groups ON groups.idgroup = monitorings.idgroup
                INNER JOIN
                userfamilies ON userfamilies.iduser = users.iduser
                INNER JOIN
                families ON families.idfamily = userfamilies.idfamily
            WHERE
                monitorings.created_at BETWEEN ADDDATE(CURDATE(),
                INTERVAL 1 - DAYOFWEEK(CURDATE()) DAY) AND ADDDATE(CURDATE(),
                INTERVAL 7 - DAYOFWEEK(CURDATE()) DAY)
                AND email IS NOT NULL
            GROUP BY users.iduser
            HAVING amount >= 1
            ORDER BY groups.idgroup,student");
        return $data;
    }

    /**
     * Get All Monitorings For Parents
     * @param $year
     * @param $period
     * @param null $group
     * @param $user
     * @return mixed
     */
    public static function getMonitoringsForParents($year, $period, $group = null, $user)
    {
        return DB::select("call globalPerformanceByStudentForParents($year,$period,$group,$user)");;
    }
}