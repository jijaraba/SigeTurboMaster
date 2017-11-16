<?php

namespace SigeTurbo\Repositories\Voucherconsecutive;

use Illuminate\Support\Facades\Cache;
use SigeTurbo\Voucherconsecutive;

class VoucherconsecutiveRepository implements VoucherconsecutiveRepositoryInterface
{

    /**
     * Get All Voucherconsecutive
     * @return mixed
     */
    public function all()
    {
        return Cache::remember('voucherconsecutives', 1440, function () {
            return Voucherconsecutive::select('voucherconsecutives.*');
        });
    }

    /**
     * Get Voucherconsecutive BY ID
     * @param $voucherconsecutive
     * @return mixed
     */
    public function find($voucherconsecutive)
    {
        return Voucherconsecutive::find($voucherconsecutive);
    }

    /**
     * Get Consecutive By Document Type
     * @param $type
     * @return mixed
     */
    public function getCurrentDocumentByType($type)
    {
        return Voucherconsecutive::select("voucherconsecutives.*")
            ->whereDocumenttype($type)
            ->first();
    }

    /**
     * Update VoucherConsecutive
     * @param $document
     * @return mixed
     */
    public function updateDocumentByID($document)
    {
        //Find Voucherconsecutive
        $document = Voucherconsecutive::find($document);
        $document->fill(array(
            'consecutive' => $document->consecutive + 1
        ));
        return $document->save();
    }

    /**
     * Get Voucherconsecutives By Name
     * @param $name
     * @return mixed
     */
    public function getVoucherConsecutiveByName($name)
    {
        return Voucherconsecutive::select("voucherconsecutives.*")
            ->join('vouchertypes', function ($join) {
                $join->on('vouchertypes.idvouchertype', '=', 'voucherconsecutives.idvouchertype');
            })
            ->where('vouchertypes.documenttype', '=', $name)
            ->first();
    }

    /**
     * Get Voucherconsecutives By Code
     * @param $code
     * @return mixed
     */
    public function getVoucherConsecutiveByCode($code)
    {
        return Voucherconsecutive::select("voucherconsecutives.*")
            ->join('vouchertypes', function ($join) {
                $join->on('vouchertypes.idvouchertype', '=', 'voucherconsecutives.idvouchertype');
            })
            ->where('vouchertypes.code', '=', $code)
            ->first();
    }
}