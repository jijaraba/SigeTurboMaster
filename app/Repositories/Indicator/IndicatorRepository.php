<?php

namespace SigeTurbo\Repositories\Indicator;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use SigeTurbo\Indicator;

class IndicatorRepository implements IndicatorRepositoryInterface
{
    /**
     * Get All Indicators
     * @return mixed
     */
    public function all()
    {
        return Cache::remember('indicators', 1440, function () {
            return Indicator::all();
        });
    }

    /**
     * Find Indicator
     * @param $idindicator
     * @return mixed
     */
    public function find($idindicator)
    {
        return Indicator::find($idindicator);
    }


    /**
     * Save Indicator
     * @param $data
     * @return mixed
     */
    public function storeFortitude($data)
    {
        return Indicator::create(array(
            'idachievement' => $data['achievement'],
            'consecutive' => $data['consecutive'],
            'idindicatortype' => $data['type01'],
            'idindicatorcategory' => $data['indicatorcategory'],
            'indicator' => $data['fortitude']
        ));

    }

    /**
     * Save Indicator
     * @param $data
     * @return mixed
     */
    public function storeRecommendation($data)
    {
        return Indicator::create(array(
            'idachievement' => $data['achievement'],
            'consecutive' => $data['consecutive'],
            'idindicatortype' => $data['type02'],
            'idindicatorcategory' => $data['indicatorcategory'],
            'indicator' => $data['recommendation']
        ));

    }


    /**
     * Update Indicator Fortitude
     * @param $data
     * @return mixed
     */
    public function updateFortitude($indicator, $data)
    {

        $indicator = Indicator::find($indicator);
        $indicator->fill(array(
            'idachievement' => $data['achievement'],
            'consecutive' => $data['consecutive'],
            'idindicatortype' => $data['type01'],
            'idindicatorcategory' => $data['indicatorcategory'],
            'indicator' => $data['fortitude'],
            'updated_at' => Carbon::now()
        ));
        return $indicator->save();

    }

    /**
     * Update Indicator Recomendation
     * @param $data
     * @return mixed
     */
    public function updateRecommendation($indicator, $data)
    {

        $indicator = Indicator::find($indicator);
        $indicator->fill(array(
            'idachievement' => $data['achievement'],
            'consecutive' => $data['consecutive'],
            'idindicatortype' => $data['type02'],
            'idindicatorcategory' => $data['indicatorcategory'],
            'indicator' => $data['recommendation'],
            'updated_at' => Carbon::now()
        ));
        return $indicator->save();

    }

    /**
     * Get Indicators
     * @param $data
     * @return mixed
     */
    public function getIndicatorsByGroup($data)
    {
        return Cache::remember("indicator_" . $data['year'] . $data['period'] . $data['group'] . $data['subject'] . $data['nivel'], 1440, function () use ($data) {
            return Indicator::whereRaw('idyear = ? AND idperiod = ? AND idgroup = ? AND idsubject = ? AND idnivel = ?', array($data['year'], $data['period'], $data['group'], $data['subject'], $data['nivel']))
                ->orderBy('idmonitoringcategory', 'ASC')
                ->orderBy('created_at', 'ASC')
                ->orderBy('idmonitoringcategory', 'ASC')
                ->get();
        });

    }

    /**
     * Get Indicators
     * @param $data
     * @return mixed
     */
    public function getIndicators($data)
    {

        return Indicator::select("indicators.*", 'indicatorcategories.name AS category', 'indicatorcategories.prefix AS category_prefix')
            ->join('indicatorcategories', function ($join) {
                $join->on('indicatorcategories.idindicatorcategory', '=', 'indicators.idindicatorcategory');
            })
            ->where('indicators.idachievement', '=', DB::raw("(SELECT idachievement FROM achievements WHERE idyear =" . $data['year'] . " AND idperiod = " . $data['period'] . " AND idgrade = (SELECT idgrade FROM groups WHERE idgroup = " . $data['group'] . ") AND idsubject = " . $data['subject'] . " AND idnivel = " . $data['nivel'] . " LIMIT 1)"))
            ->where('indicators.idindicatortype', '=', 1)
            ->orderBy('indicators.consecutive')
            ->get();

    }

    /**
     * Get Indicators Pendings By Teacher
     * @param $year
     * @param $period
     * @param $user
     * @return mixed
     */
    public function getIndicatorsPendingByTeacher($year = 1995, $period = 1, $user)
    {
        return (array)DB::select(DB::raw("
                SELECT
                    idyear,idperiod,groups.name AS 'group',subjects.name AS 'subject',nivels.name AS 'nivel',CONCAT_WS(CONVERT(' ' USING latin1),users.lastname,users.firstname) AS Teacher,
                    CONCAT_WS(CONVERT(' ' USING latin1),'Usted no ha ingresado los indicadores correspondientes a :',subjects.name,' en el nivel:',nivels.name,'del grupo',groups.name) AS Script
                FROM contracts
                INNER JOIN groups ON contracts.idgroup= groups.idgroup
                INNER JOIN subjects ON contracts.idsubject = subjects.idsubject
                INNER JOIN nivels ON contracts.idnivel = nivels.idnivel
                INNER JOIN users ON contracts.iduser = users.iduser
                WHERE contracts.idyear = " . $year . " and contracts.idperiod = " . $period . " AND contracts.iduser = " . $user . "
                    AND
                    NOT EXISTS
                            (
                                SELECT
                                    idyear, idperiod, idgroup, idsubject, idnivel,idachievement,  achievement, idindicator, consecutive, idindicatortype
                                    FROM(SELECT
                                    achievements.idachievement, idyear, idperiod, achievements.idgrade, idsubject, idnivel, achievement, idindicator, consecutive, idindicatortype,groups.idgroup,'A' AS grouptype
                                FROM achievements
                                INNER JOIN indicators ON achievements.idachievement = indicators.idachievement
                                INNER JOIN groups ON groups.idgrade = achievements.idgrade
                                WHERE achievements.idyear = " . $year . " and achievements.idperiod = " . $period . "
                                GROUP BY idachievement
                                UNION
                                SELECT
                                    achievements.idachievement, idyear, idperiod, achievements.idgrade, idsubject, idnivel, achievement, idindicator, consecutive, idindicatortype,groups.idgroup + 1,'B' AS grouptype
                                FROM achievements
                                INNER JOIN indicators ON achievements.idachievement = indicators.idachievement
                                INNER JOIN groups ON groups.idgrade = achievements.idgrade
                                WHERE achievements.idyear = " . $year . " and achievements.idperiod = " . $period . "
                                GROUP BY idachievement
                                ) AS tbl1
                                WHERE contracts.idyear = tbl1.idyear and contracts.idperiod = tbl1.idperiod and contracts.idgroup = tbl1.idgroup and contracts.idsubject = tbl1.idsubject and contracts.idnivel = tbl1.idnivel)
                                AND ((contracts.idgroup > 10) OR (contracts.idgroup < 10 AND contracts.idsubject = 54)
                            )
                ORDER BY contracts.idyear,contracts.idperiod,contracts.idgroup,contracts.idsubject,contracts.idnivel"
        ));
    }

}