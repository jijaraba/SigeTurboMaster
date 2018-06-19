<?php

namespace SigeTurbo;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{

    const PACKAGE_1101 = 1;
    const PACKAGE_1102 = 2;
    const PACKAGE_1103 = 3;
    const PACKAGE_1104 = 4;
    const PACKAGE_1105 = 5;
    const PACKAGE_1106 = 6;
    const PACKAGE_1107 = 7;
    const PACKAGE_1108 = 8;
    const PACKAGE_1109 = 9;
    const PACKAGE_1110 = 10;
    const PACKAGE_1111 = 11;
    const PACKAGE_1112 = 12;

    protected $primaryKey = 'idpackage';
    protected $fillable = ['idconcepttype', 'code', 'name', 'active', 'modifiable', 'process', 'created_by', 'updated_by'];
    protected $hidden = ['created_at', 'updated_at'];
    /**
     * Table Name
     * @var string
     */
    protected $table = 'packages';

    /**
     * @return mixed
     */
    public function concepttype()
    {
        return $this->belongsTo('SigeTurbo\Concepttype');
    }

    /**
     * @return mixed
     */
    public function costpackages()
    {
        return $this->hasMany('SigeTurbo\Costpackage', 'idpackage', 'idpackage');
    }
}
