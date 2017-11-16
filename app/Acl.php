<?php

namespace SigeTurbo;

use Illuminate\Database\Eloquent\Model;

class Acl extends Model {

    protected $primaryKey = 'idacl';
    protected $fillable = ['route','roles'];
    protected $hidden = ['created_at', 'updated_at'];
    /**
     * Table Name
     * @var string
     */
    protected $table = 'acls';

    /**
     * Get Permission
     * @param $route
     * @param $roles
     * @return mixed
     */
    public static function isAllow($route, $roles){
        return static::where('route','=',$route)
            ->where('roles','LIKE', "%$roles%")
            ->first();
    }

}