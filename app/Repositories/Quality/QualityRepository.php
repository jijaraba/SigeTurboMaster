<?php

namespace SigeTurbo\Repositories\Quality;

use Illuminate\Support\Facades\Cache;
use SigeTurbo\Quality;

class QualityRepository implements QualityRepositoryInterface
{


    /**
     * Get All Qualities
     * @return mixed
     */
    public function all()
    {
        return Cache::remember('qualities', 1440, function () {
            return Quality::select('qualities.*')
                ->get();
        });
    }

    public function find($quality)
    {
        return Quality::find($quality);
    }
}