<?php

namespace SigeTurbo\Repositories\Tasktype;

use Illuminate\Support\Facades\Cache;
use SigeTurbo\Tasktype;

class TasktypeRepository implements TasktypeRepositoryInterface
{
    /**
     * Get All Tasktypes
     * @return mixed
     */
    public function all()
    {
        return Cache::remember('tasktypes', 1440, function () {
            return Tasktype::all();
        });
    }

    /**
     * Find Tasktype
     * @param $idtasktype
     * @return mixed
     */
    public function find($idtasktype)
    {
        return Tasktype::find($idtasktype);
    }


}