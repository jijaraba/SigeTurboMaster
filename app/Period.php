<?php

namespace SigeTurbo;

use Illuminate\Database\Eloquent\Model;

class Period extends Model
{

    protected $primaryKey = 'idperiod';
    protected $fillable = ['name', 'prefix'];
    protected $hidden = ['created_at', 'updated_at'];
    /**
     * Table Name
     * @var string
     */
    protected $table = 'periods';

    /**
     * @return mixed
     */
    public function monitoringtype()
    {
        return $this->hasMany('SigeTurbo\Monitoringtype', 'idperiod', 'idperiod');
    }

    /**
     * @return mixed
     */
    public function monitoring()
    {
        return $this->hasMany('SigeTurbo\Monitoring', 'idperiod', 'idperiod');
    }

    /**
     * @return mixed
     */
    public function achievement()
    {
        return $this->hasMany('SigeTurbo\Achievement', 'idperiod', 'idperiod');
    }

    /**
     * @return mixed
     */
    public function contract()
    {
        return $this->hasMany('SigeTurbo\Contract', 'idperiod', 'idperiod');
    }

    /**
     * @return mixed
     */
    public function academic()
    {
        return $this->hasMany('SigeTurbo\Academic', 'idperiod', 'idperiod');
    }

    /**
     * @return mixed
     */
    public function attendance()
    {
        return $this->hasMany('SigeTurbo\Attendance', 'idperiod', 'idperiod');
    }


    /**
     * @return mixed
     */
    public function quantitativerecovery()
    {
        return $this->hasMany('SigeTurbo\Quantitativerecovery', 'idperiod', 'idperiod');
    }

    /**
     * @return mixed
     */
    public function partialrating()
    {
        return $this->hasMany('SigeTurbo\Partialrating', 'idperiod', 'idperiod');
    }

    /**
     * @return mixed
     */
    public function descriptivereport()
    {
        return $this->hasMany('SigeTurbo\Descriptivereport', 'idperiod', 'idperiod');
    }

}