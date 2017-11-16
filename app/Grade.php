<?php

namespace SigeTurbo;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{

    protected $primaryKey = 'idgrade';
    protected $fillable = ['name', 'prefix', 'description', 'active', 'order'];
    protected $hidden = ['created_at', 'updated_at'];
    /**
     * Table Name
     * @var string
     */
    protected $table = 'grades';

    /**
     * @return mixed
     */
    public function group()
    {
        return $this->hasMany('SigeTurbo\Group', 'idgrade', 'idgrade');
    }

    /**
     * @return mixed
     */
    public function achievement()
    {
        return $this->hasMany('SigeTurbo\Achievement', 'idgrade', 'idgrade');
    }

    /**
     * @return mixed
     */
    public function costs()
    {
        return $this->hasMany('SigeTurbo\Cost', 'idgrade', 'idgrade');
    }

    /**
     * @return mixed
     */
    public function grades()
    {
        return $this->hasMany('SigeTurbo\Schoolinformation', 'idgrade', 'idgrade');
    }

}