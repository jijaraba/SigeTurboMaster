<?php

namespace SigeTurbo;

use Illuminate\Database\Eloquent\Model;

class Tasktype extends Model
{

    protected $primaryKey = 'idtasktype';
    protected $fillable = ['name'];
    protected $hidden = ['created_at', 'updated_at'];
    /**
     * Table Name
     * @var string
     */
    protected $table = 'tasktypes';

    /**
     * @return mixed
     */
    public function tasks()
    {
        return $this->hasMany('SigeTurbo\Task', 'idtasktype', 'idtasktype');
    }


}