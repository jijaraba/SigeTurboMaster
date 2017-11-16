<?php

namespace SigeTurbo\Repositories\Calendar;

use Illuminate\Support\Facades\Cache;
use SigeTurbo\Calendar;

class CalendarRepository implements CalendarRepositoryInterface {

    /**
     * Return all values
     * @return mixed
     */
    public function all()
    {
        return Cache::remember('calendars', 1440, function() {
            return Calendar::all();
        });

    }

    /**
     * Find in Databases
     * @param $calendar
     * @return mixed
     */
    public function find($calendar)
    {
        return Calendar::find($calendar);
    }

}