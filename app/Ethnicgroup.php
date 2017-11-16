<?php

namespace SigeTurbo;

use Illuminate\Database\Eloquent\Model;

class Ethnicgroup extends Model
{

    protected $primaryKey = 'idethnicgroup';
    protected $fillable = ['name'];
    protected $hidden = ['created_at', 'updated_at'];
    /**
     * Table Name
     * @var string
     */
    protected $table = 'ethnicgroups';


    /**
     * @return mixed
     */
    public function user()
    {
        return $this->hasMany('SigeTurbo\User', 'idethnicgroup', 'idethnicgroup');
    }

}