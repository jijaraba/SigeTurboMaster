<?php

namespace SigeTurbo;

use Illuminate\Database\Eloquent\Model;

class Enrollmentlog extends Model
{
    protected $primaryKey = 'idenrollmentlog';
    protected $fillable = ['idenrollment','description','created_by'];
    protected $hidden = ['created_at', 'updated_at'];
    /**
     * Table Name
     * @var string
     */
    protected $table = 'enrollmentlogs';

    /**
     * @return mixed
     */
    public function enrollment()
    {
        return $this->belongsTo('SigeTurbo\Enrollment');
    }
}
