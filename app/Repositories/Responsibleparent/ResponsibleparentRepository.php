<?php

namespace SigeTurbo\Repositories\Responsibleparent;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;
use SigeTurbo\Responsibleparent;

class ResponsibleparentRepository implements ResponsibleparentRepositoryInterface
{

    /**
     * Get All Responsibleparents
     * @return mixed
     */
    public function all()
    {
        return Cache::remember('responsibleparents', 1440, function () {
            return Responsibleparent::all();
        });
    }

    /**
     * Find Responsibleparent By ID
     * @param $responsible
     * @return mixed
     */
    public function find($responsible)
    {
        return Responsibleparent::find($responsible);
    }

    /**
     * Save Responsible Parents
     * @param $data
     * @return static
     */
    public function store($data)
    {
        return Responsibleparent::create([
            'iduser' => $data['responsibleparent_user'],
            'responsible' => $data['responsible'],
            'created_by' => getUser()->iduser,
            'created_at' => Carbon::now()
        ]);
    }

    /**
     * Update Responsible Parents
     * @param $idresponsibleparent
     * @param $data
     * @return mixed
     */
    public function update($idresponsibleparent, $data)
    {
        //Find Purchase
        $responsibleparent = Responsibleparent::find($idresponsibleparent);
        $responsibleparent->fill(array(
            'iduser' => $data['responsibleparent_user'],
            'responsible' => $data['responsible'],
            'updated_by' => getUser()->iduser,
            'updated_at' => Carbon::now()
        ));
        return $responsibleparent->save();
    }


    /**
     * Get Responsible By Student
     * @param $responsible
     * @return mixed
     */
    public function getResponsibleByStudent($responsible)
    {
        return Responsibleparent::select("*")
            ->where('iduser', '=', $responsible)
            ->first();
    }
}