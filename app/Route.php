<?php

namespace SigeTurbo;

use Illuminate\Database\Eloquent\Model;

class Route extends Model
{

    protected $primaryKey = 'idroute';
    protected $fillable = ['idvehicle', 'idconveyor', 'idcompanion', 'name', 'hour'];
    protected $hidden = ['created_at', 'updated_at'];

    /**
     * Table Name
     * @var string
     */
    protected $table = 'routes';

    /**
     * @return mixed
     */
    public function Vehicle()
    {
        return $this->belongsTo('SigeTurbo\Vehicle');
    }

    /**
     * @return mixed
     */
    public function Conveyor()
    {
        return $this->belongsTo('SigeTurbo\Conveyor');
    }

    /**
     * @return mixed
     */
    public function route()
    {
        return $this->hasMany('SigeTurbo\Route', 'idroute', 'idroute');
    }

}