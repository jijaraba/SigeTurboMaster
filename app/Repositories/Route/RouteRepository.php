<?php

namespace SigeTurbo\Repositories\Route;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use SigeTurbo\Route;

class RouteRepository implements RouteRepositoryInterface {

    /**
     * Return all values
     * @return mixed
     */
    public function all()
    {
        //return Route::select('*')->remember(1440,'routes');
        return Cache::remember('routes', 1440, function() {
            return Route::all();
        });
    }

    /**
    *Get Routes By Key And Value
    *@param $index String
    *@param $value String
    */
    public function getRoutesByIndexAndValue($index, $value)
    {
        if ($index == 'iduser') {
                $routes = Route::whereIn('idroute', function ($query) use ($index,$value) {
                $query
                    ->select('routebyusers.idroute')
                    ->from('routebyusers')
                    ->where('routebyusers.iduser', '=', $value);
            });
        }else $routes = Route::where($index, 'LIKE', "%" . $value . "%"); 
        return $routes->get();
    }

    /**
     * Find in Databases
     * @param $idroute
     * @return mixed
     */
    public function find($idroute)
    {
        return Route::find($idroute);
    }

    /**
     * Save Route
     * @param $data
     * @return static
     */
    public function store($data)
    {
        return Route::create(array(
            'idvehicle' => $data['idvehicle'],
            'idconveyor' => $data['idconveyor'],
            'idcompanion' => $data['idcompanion'],
            'name' => $data['name'],
            'hour' => $data['hour'],
            'created_at' => Carbon::now()
        ));
    }

    /**
     * Update Route
     * @param $route
     * @param $data
     * @return mixed
     */
    public function update($route,$data)
    {
        $route = Route::find($route);
        $route->fill(array(
            'idvehicle' => $data['idvehicle'],
            'idconveyor' => $data['idconveyor'],
            'idcompanion' => $data['idcompanion'],
            'name' => $data['name'],
            'hour' => $data['hour'],
            'updated_at' => Carbon::now()
         ));
        return $route->save();

    }

    /**
     * Delete Route
     * @param $route
     * @return mixed
     * @internal param $data
     */
    public function destroy($route)
    {
        //Find Route
        $route = Route::find($route);
        return $route->delete();
    }

    /**
     * Get Routes With Data
     * @param $data
     * @return mixed
     */
    public function getRoutesWithData(){
        return Route::select('routes.idroute','vehicles.plate', 'vehicles.type AS Typevehicle',
            DB::raw("CONCAT_WS(CONVERT(' ' USING latin1),conveyors.lastname,conveyors.firstname) AS Convenyor"),'conveyors.celular AS celularconveyor',
            DB::raw("CONCAT_WS(CONVERT(' ' USING latin1),companions.lastname,companions.firstname) AS Companion"),'companions.celular AS celularcompanion',
            'routes.name AS Nameroute', 'name','hour','routes.idvehicle','routes.idconveyor','routes.idcompanion','conveyors.lastname as lastnameconveyor','conveyors.firstname as firstnameconveyor',
            'companions.lastname as lastnamecompanion','companions.firstname AS firstnamecompanion')
            ->join('vehicles', function ($join) {
                $join
                    ->on('vehicles.idvehicle', '=', 'routes.idvehicle');
            })
            ->join('conveyors', function ($join) {
                $join
                    ->on('conveyors.idconveyor', '=', 'routes.idconveyor');
            })
            ->join('conveyors AS companions', function ($join) {
                $join
                    ->on('companions.idconveyor', '=', 'routes.idcompanion');
            })
            ->orderBy('routes.idroute', 'ASC')
            ->get();
    }
}

