<?php

namespace SigeTurbo;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{

    protected $primaryKey = 'iddepartment';
    protected $fillable = ['idcountry', 'name'];
    protected $hidden = ['created_at', 'updated_at'];
    /**
     * Table Name
     * @var string
     */
    protected $table = 'departments';

    /**
     * @return mixed
     */
    public function Country()
    {
        return $this->belongsTo('SigeTurbo\Country');
    }

    /**
     * @return mixed
     */
    public function town()
    {
        return $this->hasMany('SigeTurbo\Town', 'iddepartment', 'iddepartment');
    }

}