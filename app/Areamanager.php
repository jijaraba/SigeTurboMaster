<?php

namespace SigeTurbo;

use Illuminate\Database\Eloquent\Model;

class Areamanager extends Model
{

    protected $primaryKey = 'idareamanager';
    protected $fillable = ['idyear', 'idarea', 'iduser'];
    protected $hidden = ['created_at', 'updated_at'];
    /**
     * Table Name
     * @var string
     */
    protected $table = 'areamanagers';

}
