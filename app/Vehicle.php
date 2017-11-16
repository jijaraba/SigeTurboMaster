<?php

namespace SigeTurbo;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{

    protected $primaryKey = 'idvehicle';
    protected $fillable = ['plate', 'type'];
    protected $hidden = ['created_at', 'updated_at'];

    /**
     * Table Name
     * @var string
     */
    protected $table = 'vehicles';

    /**
     * @return mixed
     */
    public function route()
    {
        return $this->hasMany('SigeTurbo\Route', 'idvehicle', 'idvehicle');
    }

}