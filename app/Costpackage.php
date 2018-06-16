<?php

namespace SigeTurbo;

use Illuminate\Database\Eloquent\Model;

class Costpackage extends Model
{
    protected $primaryKey = 'idcostpackage';
    protected $fillable = ['idpackage', 'idaccounttype', 'idvouchercategory', 'idtransactiontype', 'percentage', 'calculated', 'factor', 'created_by', 'updated_by'];
    protected $hidden = ['created_at', 'updated_at'];
    /**
     * Table Name
     * @var string
     */
    protected $table = 'costpackages';
}
