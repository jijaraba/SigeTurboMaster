<?php

namespace SigeTurbo;

use Illuminate\Database\Eloquent\Model;

class Bloodtype extends Model
{

    protected $primaryKey = 'idbloodtype';
    protected $fillable = ['name'];
    protected $hidden = ['created_at', 'updated_at'];
    /**
     * Table Name
     * @var string
     */
    protected $table = 'bloodtypes';

    /**
     * @return mixed
     */
    public function preregistration()
    {
        return $this->hasMany('SigeTurbo\Preregistration', 'idbloodtype', 'idbloodtype');
    }

    /**
     * @return mixed
     */
    public function healthinformation()
    {
        return $this->hasMany('SigeTurbo\Healthinformation', 'idbloodtype', 'idbloodtype');
    }

}
