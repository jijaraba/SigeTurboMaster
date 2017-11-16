<?php

namespace SigeTurbo\Repositories\Schoolinformation;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use SigeTurbo\Schoolinformation;

class SchoolinformationRepository implements SchoolinformationRepositoryInterface
{

    /**
     * Show All Schoolinformation
     * Return all values
     * @return mixed
     */
    public function all()
    {

        return Cache::remember('schoolinformations', 1440, function () {
            return Schoolinformation::all();
        });
    }

    /**
     * Find in Databases
     * @param $schoolinformation
     * @return mixed
     */
    public function find($schoolinformation)
    {
        return Schoolinformation::find($schoolinformation);
    }

    /**
     * Insert Schoolinformation
     * @param $data
     * @return mixed
     */
    public function store($data)
    {
        return Schoolinformation::create(array(
            'iduser' => $data['schoolinformation_user'],
            'idcalendar' => $data['calendar'],
            'idgrade' => $data['grade'],
            'idenrollmentreason' => $data['reason'],
            'school' => $data['school'],
            'ubication' => $data['ubication'],
            'phone' => ($data['phone'] == '') ? NULL : $data['phone'],
            'approved' => ($data['approved'] == 'on') ? 'Y' : 'N',
            'observation' => ($data['observation'] == '') ? NULL : $data['observation'],
            "created_by" => getUser()->iduser,
            'created_at' => Carbon::now(),
        ));
    }


    /**
     * Update Schoolinformation
     * @param $schoolinformation
     * @param $data
     * @return mixed
     */
    public function update($schoolinformation, $data)
    {
        //Find Schoolinformation
        $schoolinformation = Schoolinformation::find($schoolinformation);
        $schoolinformation->fill([
            'iduser' => $data['schoolinformation_user'],
            'idcalendar' => $data['calendar'],
            'idgrade' => $data['grade'],
            'idenrollmentreason' => $data['reason'],
            'school' => $data['school'],
            'ubication' => $data['ubication'],
            'phone' => ($data['phone'] == '') ? NULL : $data['phone'],
            'approved' => ($data['approved'] == 'on') ? 'Y' : 'N',
            'observation' => ($data['observation'] == '') ? NULL : $data['observation'],
            "updated_by" => getUser()->iduser,
            'updated_at' => Carbon::now()
        ]);
        return $schoolinformation->save();

    }

}
