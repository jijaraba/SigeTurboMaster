<?php

namespace SigeTurbo;

use Illuminate\Database\Eloquent\Model;

class Town extends Model
{

    protected $primaryKey = 'idtown';
    protected $fillable = ['iddepartment', 'name'];
    protected $hidden = ['created_at', 'updated_at'];
    /**
     * Table Name
     * @var string
     */
    protected $table = 'towns';

    /**
     * @return mixed
     */
    public function department()
    {
        return $this->belongsTo('SigeTurbo\Department');
    }


}