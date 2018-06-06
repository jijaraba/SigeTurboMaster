<?php

namespace SigeTurbo;

use Illuminate\Database\Eloquent\Model;

class Statusschooltype extends Model
{

    const STATUS_ACTIVE = [1, 6, 11, 13];
    const STATUS_NOT_ACTIVE = [2, 3, 4, 5, 7, 8, 9, 10, 12, 14];
    const STATUS_PREENROLLMENT = [14];
    const STATUS_ACTIVE_WITH_PREENROLLMENT = [1, 6, 11, 13, 14];
    const STATUSES = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14];

    protected $primaryKey = 'idstatusschooltype';
    protected $fillable = ['name', 'duration'];
    protected $hidden = ['created_at', 'updated_at'];
    /**
     * Table Name
     * @var string
     */
    protected $table = 'statusschooltypes';


    /**
     * @return mixed
     */
    public function enrollment()
    {
        return $this->hasMany('SigeTurbo\Enrollment', 'idstatusschooltype', 'idstatusschooltype');
    }

}