<?php

namespace SigeTurbo\Repositories\Period;

use Illuminate\Support\Facades\Cache;
use SigeTurbo\Period;

class PeriodRepository implements PeriodRepositoryInterface
{

    /**
     * Return all values
     * @return mixed
     */
    public function all()
    {
        return Cache::remember('periods', 1440, function () {
            return Period::all();
        });
    }

    /**
     * Find in Databases
     * @param $idperiod
     * @return mixed
     */
    public function find($idperiod)
    {
        return Period::find($idperiod);
    }


    /**
     * Get Periods By Year and User
     * @param int $year
     * @param null $user
     * @return mixed
     */
    public function getPeriodsByYear($year = 1995, $user = null)
    {
        $periods = Period::select('periods.idperiod', 'periods.name')
            ->join('contracts', function ($join) {
                $join
                    ->on('contracts.idperiod', '=', 'periods.idperiod');
            })
            ->join('years', function ($join) {
                $join
                    ->on('years.idyear', '=', 'contracts.idyear');
            })
            ->where('years.idyear', '=', $year);
        if ($user) {
            $periods
                ->join('users', function ($join) {
                    $join
                        ->on('users.iduser', '=', 'contracts.iduser');
                })
                ->where('contracts.iduser', '=', $user);
        }
        return $periods
            ->groupBy('contracts.idperiod')
            ->get();
    }

    /**
     * Get Current Period
     * @param int $calendar
     * @return mixed
     */
    public function getCurrentPeriod($calendar = 2)
    {
        return Cache::remember('current_period', 1440, function () use ($calendar) {
            return Period::select('periods.idperiod', 'periods.name')
                ->join('academics', function ($join) {
                    $join
                        ->on('academics.idperiod', '=', 'periods.idperiod');
                })
                ->join('years', function ($join) {
                    $join
                        ->on('years.idyear', '=', 'academics.idyear');
                })
                ->join('calendars', function ($join) {
                    $join
                        ->on('calendars.idcalendar', '=', 'academics.idcalendar');
                })
                ->where('calendars.idcalendar', '=', $calendar)
                ->whereRaw('academics.rating >= CURDATE()')
                ->whereRaw('academics.starts <= CURDATE()')
                ->first();
        });

    }

}
