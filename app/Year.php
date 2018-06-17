<?php

namespace SigeTurbo;

use Illuminate\Database\Eloquent\Model;

class Year extends Model
{

    protected $primaryKey = 'idyear';
    protected $fillable = ['idcalendar', 'name', 'prefix', 'starts', 'ends', 'preregistration_starts', 'preregistration_ends'];
    protected $hidden = ['created_at', 'updated_at'];
    /**
     * Table Name
     * @var string
     */
    protected $table = 'years';

    /**
     * @return mixed
     */
    public function payments()
    {
        return $this->hasMany('SigeTurbo\Payment', 'idyear', 'idyear');
    }


    /**
     * @return mixed
     */
    public function enrollment()
    {
        return $this->hasMany('SigeTurbo\Enrollment', 'idyear', 'idyear');
    }

    /**
     * @return mixed
     */
    public function monitoringcategorybyyear()
    {
        return $this->hasMany('SigeTurbo\Monitoringcategorybyyear', 'idyear', 'idyear');
    }


    /**
     * @return mixed
     */
    public function monitoringtype()
    {
        return $this->hasMany('SigeTurbo\Monitoringtype', 'idyear', 'idyear');
    }

    /**
     * @return mixed
     */
    public function monitoring()
    {
        return $this->hasMany('SigeTurbo\Monitoring', 'idyear', 'idyear');
    }

    /**
     * @return mixed
     */
    public function achievement()
    {
        return $this->hasMany('SigeTurbo\Achievement', 'idyear', 'idyear');
    }

    /**
     * @return mixed
     */
    public function contract()
    {
        return $this->hasMany('SigeTurbo\Contract', 'idyear', 'idyear');
    }

    /**
     * @return mixed
     */
    public function academic()
    {
        return $this->hasMany('SigeTurbo\Academic', 'idyear', 'idyear');
    }

    /**
     * @return mixed
     */
    public function attendance()
    {
        return $this->hasMany('SigeTurbo\Attendance', 'idyear', 'idyear');
    }

    /**
     * @return mixed
     */
    public function quantitativerecovery()
    {
        return $this->hasMany('SigeTurbo\Quantitativerecovery', 'idyear', 'idyear');
    }

    /**
     * @return mixed
     */
    public function quantitativerecoveryfinalarea()
    {
        return $this->hasMany('SigeTurbo\Quantitativerecoveryfinalarea', 'idyear', 'idyear');
    }

    /**
     * @return mixed
     */
    public function qualitativerecoveryfinalarea()
    {
        return $this->hasMany('SigeTurbo\Qualitativerecoveryfinalarea', 'idyear', 'idyear');
    }

    /**
     * @return mixed
     */
    public function partialrating()
    {
        return $this->hasMany('SigeTurbo\Partialrating', 'idyear', 'idyear');
    }

    /**
     * @return mixed
     */
    public function descriptivereport()
    {
        return $this->hasMany('SigeTurbo\Descriptivereport', 'idyear', 'idyear');
    }

    /**
     * @return mixed
     */
    public function observer()
    {
        return $this->hasMany('SigeTurbo\Observer', 'idyear', 'idyear');
    }

    /**
     * @return mixed
     */
    public function areamanagers()
    {
        return $this->hasMany('SigeTurbo\Areamanager', 'idyear', 'idyear');
    }

    /**
     * @return mixed
     */
    public function weeklyevaluations()
    {
        return $this->hasMany('SigeTurbo\Weeklyevaluation', 'idyear', 'idyear');
    }

    /**
     * @return mixed
     */
    public function costs()
    {
        return $this->hasMany('SigeTurbo\Cost', 'idyear', 'idyear');
    }

    /**
     * @return mixed
     */
    public function attendancecontrols()
    {
        return $this->hasMany('SigeTurbo\Attendancecontrol', 'idyear', 'idyear');
    }

}
