<?php

namespace SigeTurbo\Repositories\Status;

use Illuminate\Support\Facades\Cache;
use SigeTurbo\Status;

class StatusRepository implements StatusRepositoryInterface {

    /**
     * Return all values
     * @return mixed
     */
    public function all()
    {
        return Cache::remember('statuses', 1440, function() {
            return Status::all();
        });
    }

    /**
     * Find in Databases
     * @param $idstatus
     * @return mixed
     */
    public function find($idstatus)
    {
        return Status::find($idstatus);
    }

}

