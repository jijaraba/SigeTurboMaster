<?php

namespace SigeTurbo;

use Illuminate\Database\Eloquent\Model;

class Conveyor extends Model
{

    protected $primaryKey = 'idconveyor';
    protected $fillable = ['firstname', 'lastname', 'celular'];
    protected $hidden = ['created_at', 'updated_at'];

    /**
     * Table Name
     * @var string
     */
    protected $table = 'conveyors';

    /**
     * @return mixed
     */
    public function route()
    {
        return $this->hasMany('SigeTurbo\Route', 'idconveyor', 'idconveyor');
    }

}