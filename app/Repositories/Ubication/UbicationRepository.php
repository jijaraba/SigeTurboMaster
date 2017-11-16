<?php

namespace SigeTurbo\Repositories\Ubication;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use SigeTurbo\Ubication;

class UbicationRepository implements UbicationRepositoryInterface
{

    /**
     * Get All Ubications
     * @return mixed
     */
    public function all()
    {
        return Cache::remember('ubications', 1440, function () {
            return Ubication::select('ubications.*')
                ->orderBy('sector','ASC')
                ->orderBy('code','ASC')
                ->get();
        });
    }

    /**
     * Get Ubication by ID
     * @param $ubication
     * @return mixed
     */
    public function find($ubication)
    {
        return Ubication::find($ubication);
    }

    /**
     * Get All Ubications
     * @param $excludeSector
     * @return mixed
     */
    public function getUbications($excludeSector)
    {
        return Ubication::select('ubications.idubication',DB::raw('CONCAT(ubications.code," - ",ubications.name) AS name'),'ubications.sector')
            ->whereNotIn('sector',$excludeSector)
            ->orderBy('ubications.sector')
            ->get();
    }
}