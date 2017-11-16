<?php

namespace SigeTurbo;

use Illuminate\Database\Eloquent\Model;

class Attendancebyemployee extends Model
{
    /**
     * Table Name
     * @var string
     */
    protected $table = 'attendancebyemployee';

    /**
     * @return mixed
     */
    public function users()
    {
        return $this->belongsTo('SigeTurbo\User');
    }
}
