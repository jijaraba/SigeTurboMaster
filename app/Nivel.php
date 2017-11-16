<?php

namespace SigeTurbo;

use Illuminate\Database\Eloquent\Model;

class Nivel extends Model
{

    protected $primaryKey = 'idnivel';
    protected $fillable = ['idsubject', 'name'];
    protected $hidden = ['created_at', 'updated_at'];
    /**
     * Table Name
     * @var string
     */
    protected $table = 'nivels';

    /**
     * @return mixed
     */
    public function subject()
    {
        return $this->belongsTo('SigeTurbo\Subject');
    }

    /**
     * @return mixed
     */
    public function monitoringtype()
    {
        return $this->hasMany('SigeTurbo\Monitoringtype', 'idnivel', 'idnivel');
    }

    /**
     * @return mixed
     */
    public function monitoring()
    {
        return $this->hasMany('SigeTurbo\Monitoring', 'idnivel', 'idnivel');
    }

    /**
     * @return mixed
     */
    public function achievement()
    {
        return $this->hasMany('SigeTurbo\Achievement', 'idnivel', 'idnivel');
    }

    /**
     * @return mixed
     */
    public function contract()
    {
        return $this->hasMany('SigeTurbo\Contract', 'idnivel', 'idnivel');
    }

    /**
     * @return mixed
     */
    public function attendance()
    {
        return $this->hasMany('SigeTurbo\Attendance', 'idnivel', 'idnivel');
    }

    /**
     * @return mixed
     */
    public function quantitativerecovery()
    {
        return $this->hasMany('SigeTurbo\Quantitativerecovery', 'idnivel', 'idnivel');
    }

    /**
     * @return mixed
     */
    public function partialrating()
    {
        return $this->hasMany('SigeTurbo\Partialrating', 'idnivel', 'idnivel');
    }

    /**
     * @return mixed
     */
    public function descriptivereport()
    {
        return $this->hasMany('SigeTurbo\Descriptivereport', 'idnivel', 'idnivel');
    }

}