<?php namespace SigeTurbo\Calendar;

use Carbon\Carbon;
use SigeTurbo\Academic;
use SigeTurbo\Repositories\Year\YearRepository;

class Calendar
{

    /**
     * Get Current Week
     * @return int
     */
    public static function getCurrentWeek()
    {
        $weekOfYear = Carbon::now('America/Bogota')->weekOfYear;
        $weekOfAcademic = Carbon::parse(Academic::getAcademicFirstPeriod()->starts)->weekOfYear;
        $currentWeek = $weekOfYear - $weekOfAcademic;
        if ($currentWeek > 0) {
            return $currentWeek;
        } else {
            $yearRepository = new YearRepository();
            return (self::getFinalWeekOfYear($yearRepository->getCurrentYear()->idyear) - $weekOfAcademic) + $weekOfYear;
        }
    }


    /**
     * Is Week Day
     * @return bool
     */
    public static function isWeekday()
    {

        if (Carbon::now('America/Bogota')->isWeekday()) {
            return true;
        }
        return false;
    }

    /**
     * Get Final Week
     * @return int
     */
    private static function getFinalWeekOfYear($year)
    {
        return Carbon::parse($year . "-12-31")->weekOfYear;
    }

}