<?php

namespace SigeTurbo\Repositories\Enrollmentreason;

use Illuminate\Support\Facades\Cache;
use SigeTurbo\Enrollmentreason;

class EnrollmentreasonRepository implements EnrollmentreasonRepositoryInterface
{

    /**
     * Return all values
     * @return mixed
     */
    public function all()
    {
        return Cache::remember('enrollmentreasons', 1440, function () {
            return Enrollmentreason::all();
        });
    }

    /**
     * Find in Databases
     * @param $enrollmentreason
     * @return mixed
     */
    public function find($enrollmentreason)
    {
        return Enrollmentreason::find($enrollmentreason);
    }

}