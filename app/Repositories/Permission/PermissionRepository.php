<?php

namespace SigeTurbo\Repositories\Permission;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use SigeTurbo\Permission;

class PermissionRepository implements PermissionRepositoryInterface
{

    /**
     * Show All Permission
     * Return all values
     * @return mixed
     */
    public function all()
    {

        return Cache::remember('permissions', 1440, function () {
            return Permission::all();
        });
    }

    /**
     * Find in Databases
     * @param $permission
     * @return mixed
     */
    public function find($permission)
    {
        return Permission::find($permission);
    }

    /**
     * Insert Permission
     * @param $data
     * @return mixed
     */
    public function store($data)
    {
        return Permission::create(array(
            'idyear' => $data['idyear'],
            'iduser' => $data['iduser'],
            'date' => ($data['date'] == '')? NULL: $data['date'],
            'entry' => $data['entry'],
            'output' => $data['output'],
            'reason' => $data['reason'],
            "created_by" => getUser()->iduser,
            'updated_at' => Carbon::now()
        ));
    }


    /**
     * Update Permission
     * @param $permission
     * @param $data
     * @return mixed
     */
    public function update($permission, $data)
    {
        //Find Permission
        $permission = Permission::find($permission);
        $permission->fill([
            'idyear' => $data['idyear'],
            'iduser' => $data['iduser'],
            'date' => ($data['date'] == '')? NULL: $data['date'],
            'entry' => $data['entry'],
            'output' => $data['output'],
            'reason' => $data['reason'],
            "updated_by" => getUser()->iduser,
            'updated_at' => Carbon::now()
        ]);
        return $permission->save();

    }

}
