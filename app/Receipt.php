<?php

namespace SigeTurbo;

use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    protected $primaryKey = 'idreceipt';
    protected $fillable = ['idvouchertype','document', 'date', 'value', 'realdate', 'description', 'created_by', 'updated_by'];
    protected $hidden = ['created_at', 'updated_at'];
    /**
     * Table Name
     * @var string
     */
    protected $table = 'receipts';

    /**
     * @return mixed
     */
    public function receiptpayments()
    {
        return $this->hasMany('SigeTurbo\Receiptpayment', 'idreceipt', 'idreceipt');
    }

    /**
     * @return mixed
     */
    public function accountingentries()
    {
        return $this->hasMany('SigeTurbo\Accountingentry', 'idreceipt', 'idreceipt');
    }

}
