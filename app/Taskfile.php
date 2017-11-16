<?php

namespace SigeTurbo;

use Illuminate\Database\Eloquent\Model;

class Taskfile extends Model
{

    protected $primaryKey = 'idtaskfile';
    protected $fillable = ['idtask', 'file', 'realname', 'size', 'extension', 'description'];
    protected $hidden = ['created_at', 'updated_at'];
    /**
     * Table Name
     * @var string
     */
    protected $table = 'taskfiles';


}