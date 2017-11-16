<?php

namespace SigeTurbo;

use Illuminate\Database\Eloquent\Model;

class Enrollmentreason extends Model
{

    protected $primaryKey = 'idenrollmentreason';
    protected $fillable = ['name'];
    protected $hidden = ['created_at', 'updated_at'];
    /**
     * Table Name
     * @var string
     */
    protected $table = 'enrollmentreasons';

    /**
     * @return mixed
     */
    public function folios()
    {
        return $this
            ->hasMany('SigeTurbo\Schoolinformation', 'idenrollmentreason', 'idenrollmentreason');
    }


}