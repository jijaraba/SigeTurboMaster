<?php

namespace SigeTurbo;

use Illuminate\Database\Eloquent\Model;

class Transactiontype extends Model
{

    CONST DEBIT = 1;
    CONST CREDIT = 2;

    protected $primaryKey = 'idtransactiontype';
    protected $fillable = ['name'];
    protected $hidden = ['created_at', 'updated_at'];
    /**
     * Table Name
     * @var string
     */
    protected $table = 'transactiontypes';


    /**
     * @return mixed
     */
    public function transactions()
    {
        return $this->hasMany('SigeTurbo\Transaction', 'idtransactiontype', 'idtransactiontype');
    }
}
