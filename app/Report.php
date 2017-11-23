<?php

namespace SigeTurbo;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $primaryKey = 'idreport';
    protected $fillable = ['idyear', 'idperiod', 'iduser', 'type', 'created_by', 'updated_by'];
    protected $hidden = ['created_at', 'updated_at'];
    /**
     * Table Name
     * @var string
     */
    protected $table = 'reports';
}
