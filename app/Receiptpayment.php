<?php

namespace SigeTurbo;

use Illuminate\Database\Eloquent\Model;

class Receiptpayment extends Model
{
    protected $primaryKey = 'idreceiptpayment';
    protected $fillable = ['idreceipt', 'idpayment', 'value', 'created_by', 'updated_by'];
    protected $hidden = ['created_at', 'updated_at'];
    /**
     * Table Name
     * @var string
     */
    protected $table = 'receiptpayments';

    /**
     * @return mixed
     */
    public function receipt()
    {
        return $this->belongsTo('SigeTurbo\Receipt');
    }

    /**
     * @return mixed
     */
    public function payment()
    {
        return $this->belongsTo('SigeTurbo\Payment');
    }

}
