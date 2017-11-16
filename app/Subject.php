<?php

namespace SigeTurbo;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{

    protected $primaryKey = 'idsubject';
    protected $fillable = ['idarea', 'name', 'prefix'];
    protected $hidden = ['created_at', 'updated_at'];
    /**
     * Table Name
     * @var string
     */
    protected $table = 'subjects';

    /**
     * @return mixed
     */
    public function area()
    {
        return $this->belongsTo('SigeTurbo\Area');
    }

    /**
     * @return mixed
     */
    public function nivel()
    {
        return $this->hasMany('SigeTurbo\Nivel', 'idsubject', 'idsubject');
    }

    /**
     * @return mixed
     */
    public function monitoringcategorybyyear()
    {
        return $this->hasMany('SigeTurbo\Monitoringcategorybyyear', 'idsubject', 'idsubject');
    }

    /**
     * @return mixed
     */
    public function monitoringtype()
    {
        return $this->hasMany('SigeTurbo\Monitoringtype', 'idsubject', 'idsubject');
    }

    /**
     * @return mixed
     */
    public function monitoring()
    {
        return $this->hasMany('SigeTurbo\Monitoring', 'idsubject', 'idsubject');
    }

    /**
     * @return mixed
     */
    public function achievement()
    {
        return $this->hasMany('SigeTurbo\Achievement', 'idsubject', 'idsubject');
    }

    /**
     * @return mixed
     */
    public function contract()
    {
        return $this->hasMany('SigeTurbo\Contract', 'idsubject', 'idsubject');
    }

    /**
     * @return mixed
     */
    public function attendance()
    {
        return $this->hasMany('SigeTurbo\Attendance', 'idsubject', 'idsubject');
    }

    /**
     * @return mixed
     */
    public function quantitativerecovery()
    {
        return $this->hasMany('SigeTurbo\Quantitativerecovery', 'idsubject', 'idsubject');
    }

    /**
     * @return mixed
     */
    public function partialrating()
    {
        return $this->hasMany('SigeTurbo\Partialrating', 'idsubject', 'idsubject');
    }

    /**
     * @return mixed
     */
    public function descriptivereport()
    {
        return $this->hasMany('SigeTurbo\Descriptivereport', 'idsubject', 'idsubject');
    }


}