<?php

namespace SigeTurbo;

use Illuminate\Database\Eloquent\Model;

class Costcenter extends Model
{

    const DEFAULT = 1;
    const PRESCHOOL = 2;
    const ELEMENTARYSCHOOL = 3;
    const MIDDLESCHOOL = 4;
    const HIGHSCHOOL = 5;

    protected $primaryKey = 'idcostcenter';
    protected $fillable = ['name', 'code', 'niif_code', 'created_by', 'updated_by'];
    protected $hidden = ['created_at', 'updated_at'];
    /**
     * Table Name
     * @var string
     */
    protected $table = 'costcenters';


    /**
     * @return mixed
     */
    public function route()
    {
        return $this->hasMany('SigeTurbo\Transaction', 'idcostcenter', 'idcostcenter');
    }

}
