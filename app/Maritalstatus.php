<?php

namespace SigeTurbo;

use Illuminate\Database\Eloquent\Model;

class Maritalstatus extends Model
{

    protected $primaryKey = 'idmaritalstatus';
    protected $fillable = ['name'];
    protected $hidden = ['created_at', 'updated_at'];
    /**
     * Table Name
     * @var string
     */
    protected $table = 'maritalstatuses';


    /**
     * @return mixed
     */
    public function user()
    {
        return $this->hasMany('SigeTurbo\User', 'idmaritalstatus', 'idmaritalstatus');
    }

}