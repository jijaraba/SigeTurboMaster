<?php

namespace SigeTurbo;

use Illuminate\Database\Eloquent\Model;

class Weeklyevaluation extends Model
{

    protected $primaryKey = 'idweeklyevaluation';
    protected $fillable = ['idyear', 'iduser', 'week', 'comment'];
    protected $hidden = ['created_at', 'updated_at'];

    /**
     * Table Name
     * @var string
     */
    protected $table = 'weeklyevaluations';
}