<?php

namespace SigeTurbo\Repositories\Medicalinsurance;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use SigeTurbo\Medicalinsurance;

class MedicalinsuranceRepository implements MedicalinsuranceRepositoryInterface
{

    /**
     * Get All Medicalinsurance
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all()
    {
        return Cache::remember('medicalinsurances', 1440, function() {
            return Medicalinsurance::all();
        });
    }

    /**
     * Find Medicalinsurance
     * @param $medicalinsurance
     * @return mixed
     */
    public function find($medicalinsurance)
    {
        return Medicalinsurance::find($medicalinsurance);
    }
}