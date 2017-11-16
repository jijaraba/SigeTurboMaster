<?php

namespace SigeTurbo\Repositories\Observer;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use SigeTurbo\Observer;

class ObserverRepository implements ObserverRepositoryInterface
{

    /**
     * Return all values
     * @return mixed
     */
    public function all()
    {
        return Observer::select('*');
    }

    /**
     * Find in Databases
     * @param $idobserver
     * @return mixed
     */
    public function find($idobserver)
    {
        return Observer::find($idobserver);
    }


    /**
     * @param $data
     * @return mixed
     */
    public function store($data)
    {
        return Observer::create([
            'idyear' => $data['year'],
            'idgroup' => $data['group'],
            'idobservertype' => $data['type'],
            'iduser' => $data['student'],
            'idteacher' => getUser()->iduser,
            'observer' => $data['observer'],
            'tags' => $data['tags'],
            'observed_at' => Carbon::now(),
        ]);
    }

    /**
     * @param $observer
     * @param $data
     * @return mixed
     */
    public function update($observer, $data)
    {
        //Find Observer
        $observer = Observer::find($observer);
        $observer->fill(array(
            'idobserver' => $data['idobserver'],
            'idobservertype' => $data['type'],
            'observer' => $data['observer'],
            'tags' => $data['tags'],
        ));
        return $observer->save();
    }

    /**
     * @param $data
     * @return mixed
     */
    public function getObservers($data)
    {
        return Observer::select('teachers.iduser AS teacher_id','teachers.photo AS teacher_photo','teachers.email AS teacher_email',DB::raw("CONCAT_WS(CONVERT(' ' USING latin1),teachers.lastname,teachers.firstname) AS teacher"),'observertypes.name AS type','observers.observed_at','observers.observer','observers.tags')
            ->join('users', function ($join) {
                $join
                    ->on('users.iduser', '=', 'observers.iduser');
            })
            ->join('users AS teachers', function ($join) {
                $join
                    ->on('teachers.iduser', '=', 'observers.idteacher');
            })
            ->join('observertypes', function ($join) {
                $join
                    ->on('observertypes.idobservertype', '=', 'observers.idobservertype');
            })
            ->where('idyear', '=', $data['year'])
            ->where('idgroup', '=', $data['group'])
            ->where('users.iduser', '=', $data['student'])
            ->get();
    }
}
