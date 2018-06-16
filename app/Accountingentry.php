<?php

namespace SigeTurbo;

use Illuminate\Database\Eloquent\Model;

class Accountingentry extends Model
{
    protected $primaryKey = 'idaccountingentry';
    protected $fillable = ['idreceipt', 'idaccounttype', 'idtransactiontype', 'idcostcenter', 'reference', 'value', 'base', 'transaction', 'term', 'nit', 'description', 'prefix', 'date', 'created_by', 'updated_by'];
    protected $hidden = ['created_at', 'updated_at'];
    /**
     * Table Name
     * @var string
     */
    protected $table = 'accountingentries';
}
