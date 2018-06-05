<?php

namespace SigeTurbo\Repositories\Year;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use SigeTurbo\Year;

class YearRepository implements YearRepositoryInterface
{

    /**
     * Return all values
     * @return mixed
     */
    public function all()
    {
        return Cache::remember('years', 1440, function () {
            return Year::select('*')->orderBy('idyear', 'DESC')->get();
        });
    }

    /**
     * Find in Databases
     * @param $idyear
     * @return mixed
     */
    public function find($idyear)
    {
        return Year::find($idyear);
    }


    /**
     * Get Current Year
     * @param int $calendar
     * @return mixed
     */
    public static function getCurrentYear($calendar = 2)
    {
        return Year::where('idcalendar', '=', $calendar)
            ->where('ends', '>=', Carbon::today())
            ->where('starts', '<=', Carbon::today())
            ->first();
    }

    /**
     * Get Preregistration
     * @param int $calendar
     * @return mixed
     */
    public function getCurrentPreregistration($calendar = 2)
    {
        return Year::where('idcalendar', '=', $calendar)
            ->where('preregistration_ends', '>=', Carbon::today())
            ->where('preregistration_starts', '<=', Carbon::today())
            ->first();
    }

}
