<?php

namespace SigeTurbo;

use Illuminate\Database\Eloquent\Model;

class Attendancecontrol extends Model
{
    /**
     * Table Name
     * @var string
     */
    protected $table = 'attendancecontrols';

    /**
     * @return mixed
     */
    public function years()
    {
        return $this->belongsTo('SigeTurbo\Year');
    }

    /**
     * @return mixed
     */
    public function users()
    {
        return $this->belongsTo('SigeTurbo\User');
    }
}
