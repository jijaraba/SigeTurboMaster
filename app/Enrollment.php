<?php

namespace SigeTurbo;

use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{

    protected $primaryKey = 'idenrollment';
    protected $fillable = ['idyear', 'idgroup', 'iduser', 'idstatusschooltype', 'register', 'reentry', 'statusdate', 'scholarship', 'inclusion', 'fieldtrip', 'isapprovedyear', 'observation', 'created_by', 'updated_by'];

    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 'enrollments';

    /**
     * The attributes excluded from the model's JSON form.
     * @var array
     */
    protected $hidden = array('created_at', 'updated_at');

    /**
     * @return mixed
     */
    public function year()
    {
        return $this->belongsTo('SigeTurbo\Year');
    }

    /**
     * @return mixed
     */
    public function group()
    {
        return $this->belongsTo('SigeTurbo\Group');
    }


    /**
     * @return mixed
     */
    public function user()
    {
        return $this->belongsTo('SigeTurbo\User');
    }

    /**
     * @return mixed
     */
    public function statusschooltype()
    {
        return $this->belongsTo('SigeTurbo\Statusschooltype');
    }

    /**
     * @return mixed
     */
    public function attendances()
    {
        return $this
            ->hasMany('SigeTurbo\Attendance', 'iduser', 'iduser');
    }


    /**
     * @return mixed
     */
    public function attendances_absent()
    {
        return $this
            ->hasMany('SigeTurbo\Attendance', 'iduser', 'iduser');
    }


    /**
     * @return mixed
     */
    public function attendances_tardy()
    {
        return $this
            ->hasMany('SigeTurbo\Attendance', 'iduser', 'iduser');
    }


    /**
     * @return mixed
     */
    public function partials()
    {
        return $this
            ->hasMany('SigeTurbo\Partialrating', 'iduser', 'iduser');
    }

    /**
     * @return mixed
     */
    public function descriptivereports()
    {
        return $this
            ->hasMany('SigeTurbo\Descriptivereport', 'iduser', 'iduser');
    }

    /**
     * @return mixed
     */
    public function attendancetoday()
    {
        return $this
            ->hasMany('SigeTurbo\Attendance', 'iduser', 'iduser');
    }


    /**
     * @return mixed
     */
    public function observers()
    {
        return $this
            ->hasMany('SigeTurbo\Observer', 'iduser', 'iduser');
    }

    /**
     * @return mixed
     */
    public function enrollmentlogs()
    {
        return $this
            ->hasMany('SigeTurbo\Enrollmentlog', 'idenrollment', 'idenrollment');
    }


}
