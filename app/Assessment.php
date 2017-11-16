<?php

namespace SigeTurbo;

use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{

    protected $primaryKey = 'idassessment';
    protected $fillable = ['name'];
    protected $hidden = ['created_at', 'updated_at'];
    /**
     * Table Name
     * @var string
     */
    protected $table = 'assessments';

}