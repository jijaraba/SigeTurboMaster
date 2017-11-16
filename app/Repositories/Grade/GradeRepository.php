<?php

namespace SigeTurbo\Repositories\Grade;

use Illuminate\Support\Facades\Cache;
use SigeTurbo\Grade;

class GradeRepository implements GradeRepositoryInterface
{
    /**
     * @return mixed
     */
    public function all()
    {
        return Cache::remember('grades', 1440, function () {
            return Grade::all();
        });
    }

    /**
     * @param $grade
     * @return mixed
     */
    public function find($grade)
    {
        return Grade::find($grade);
    }

}