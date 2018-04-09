<?php

namespace SigeTurbo;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{

    const ELEVENTH_A = 31;
    const ELEVENTH_B = 32;
    const PRESCHOOL = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
    const PRIMARY = [11, 12, 13, 14, 15, 16, 17, 18, 19, 20];
    const HIGHSCHOOL = [21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32];

    protected $primaryKey = 'idgroup';
    protected $fillable = ['idgrade', 'name', 'order', 'active'];
    protected $hidden = ['created_at', 'updated_at'];
    /**
     * Table Name
     * @var string
     */
    protected $table = 'groups';

    /**
     * @return mixed
     */
    public function grade()
    {
        return $this->belongsTo('SigeTurbo\Grade');
    }

    /**
     * @return mixed
     */
    public function enrollment()
    {
        return $this->hasMany('SigeTurbo\Enrollment', 'idgroup', 'idgroup');
    }

    /**
     * @return mixed
     */
    public function monitoringtype()
    {
        return $this->hasMany('SigeTurbo\Monitoringtype', 'idgroup', 'idgroup');
    }

    /**
     * @return mixed
     */
    public function monitoring()
    {
        return $this->hasMany('SigeTurbo\Monitoring', 'idgroup', 'idgroup');
    }

    /**
     * @return mixed
     */
    public function attendance()
    {
        return $this->hasMany('SigeTurbo\Attendance', 'idgroup', 'idgroup');
    }

    /**
     * @return mixed
     */
    public function quantitativerecovery()
    {
        return $this->hasMany('SigeTurbo\Quantitativerecovery', 'idgroup', 'idgroup');
    }

    /**
     * @return mixed
     */
    public function partialrating()
    {
        return $this->hasMany('SigeTurbo\Partialrating', 'idgroup', 'idgroup');
    }

    /**
     * @return mixed
     */
    public function descriptivereport()
    {
        return $this->hasMany('SigeTurbo\Descriptivereport', 'idgroup', 'idgroup');
    }

    /**
     * @return mixed
     */
    public function observer()
    {
        return $this->hasMany('SigeTurbo\Observer', 'idobservertype', 'idobservertype');
    }

    /**
     * @return mixed
     */
    public function quantitativerecoveryfinalarea()
    {
        return $this->hasMany('SigeTurbo\Quantitativerecoveryfinalarea', 'idgroup', 'idgroup');
    }

    /**
     * @return mixed
     */
    public function qualitativerecoveryfinalarea()
    {
        return $this->hasMany('SigeTurbo\Qualitativerecoveryfinalarea', 'idgroup', 'idgroup');
    }

}