<?php

namespace SigeTurbo;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{

    const TASK = 1;
    const PLAN = 2;
    const TERM = 3;

    protected $primaryKey = 'idtask';
    protected $fillable = ['idyear', 'idperiod', 'idgroup', 'idsubject', 'idnivel', 'idtasktype', 'iduser', 'name', 'description', 'starts', 'ends', 'days', 'status', 'created_by', 'updated_by'];
    protected $hidden = ['created_at', 'updated_at'];
    /**
     * Table Name
     * @var string
     */
    protected $table = 'tasks';

    /**
     * @return mixed
     */
    public function taskfiles()
    {
        return $this->hasMany('SigeTurbo\Taskfile', 'idtask', 'idtask');
    }


}