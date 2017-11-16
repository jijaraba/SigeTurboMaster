<?php

namespace SigeTurbo\Repositories\Routebyuser;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use SigeTurbo\Routebyuser;

class RoutebyuserRepository implements RoutebyuserRepositoryInterface {

    /**
     * Return all values
     * @return mixed
     */
    public function all()
    {
        return Routebyuser::select('*')->remember(1440,'routes');
    }

    /**
     * Find in Databases
     * @param $routebyuserId
     * @return mixed
     */
    public function find($routebyuserId)
    {
        return Routebyuser::find($routebyuserId);
    }

    /**
     * Save Routebyuser
     * @param $data
     * @return static
     */
    public function store($data)
    {
        return Routebyuser::create(array(
            'iduser' => $data['user'],
            'idroute' => $data['route'],
            'created_at' => Carbon::now()
        ));
    }

    /**
     * Update Routebyuser
     * @param $routebyuser
     * @param $data
     * @return mixed
     */
    public function update($routebyuser,$data)
    {
        $routebyuser = Routebyuser::find($routebyuser);
        $routebyuser->fill(array(
            'iduser' => $data['user'],
            'idroute' => $data['route'],
            'updated_at' => Carbon::now()
         ));
        return $routebyuser->save();
    }

    /**
     * Delete Routebyuser
     * @param $routebyuser
     * @return mixed
     * @internal param $data
     */
    public function destroy($routebyuser)
    {
        //Find Routebyuser
        $routebyuser = Routebyuser::find($routebyuser);
        return $routebyuser->delete();
    }

    /**
     * Get Users by Routes
     * @param $routeId
     * @param null $userID
     * @return mixed
    */
    public function getUsersByroute($routebyuserId,$userID = null){
        $routebyusers = Routebyuser::select('users.photo', DB::raw("CONCAT_WS(CONVERT(' ' USING latin1),users.firstname,users.lastname) AS userroute"),'categories.name AS Typeuser',
            'users.address','users.phone', 'users.celular','idroutebyuser')
            ->join('users', function ($join) {
                $join
                    ->on('users.iduser', '=', 'routebyusers.iduser');
            })
            ->join('categories', function ($join) {
                $join
                    ->on('users.idcategory', '=', 'categories.idcategory');
            })
            ->where('idroute','=',$routebyuserId)
            ->orderBy('userroute', 'ASC');
            if ($userID !== null) {
                $routebyusers->where('users.iduser', '=', $userID);
            }
            return $routebyusers->get();
    }
}