<?php

namespace SigeTurbo;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{

    protected $primaryKey = 'idstatus';
    protected $fillable = ['name'];
    protected $hidden = ['created_at', 'updated_at'];
    /**
     * Table Name
     * @var string
     */
    protected $table = 'statuses';


    /**
     * @return mixed
     */
    public function user()
    {
        return $this->hasMany('SigeTurbo\User', 'idstatus', 'idstatus');
    }

}