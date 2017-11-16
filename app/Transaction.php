<?php

namespace SigeTurbo;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $primaryKey = 'idtransaction';
    protected $fillable = ['idpayment', 'iduser', 'idvouchertype', 'idaccounttype', 'idtransactiontype', 'idcostcenter', 'document', 'reference', 'value', 'base', 'transaction', 'term', 'nit', 'date', 'realdate', 'description', 'created_by', 'updated_by'];
    protected $hidden = ['created_at', 'updated_at'];
    /**
     * Table Name
     * @var string
     */
    protected $table = 'transactions';

    /**
     * @return mixed
     */
    public function payment()
    {
        return $this->belongsTo('SigeTurbo\Payment');
    }

    /**
     * @return mixed
     */
    public function voucher()
    {
        return $this->belongsTo('SigeTurbo\Voucher');
    }

    /**
     * @return mixed
     */
    public function vouchertype()
    {
        return $this->belongsTo('SigeTurbo\Vouchertype');
    }

    /**
     * @return mixed
     */
    public function accounttype()
    {
        return $this->belongsTo('SigeTurbo\Accounttype');
    }

    /**
     * @return mixed
     */
    public function transactiontype()
    {
        return $this->belongsTo('SigeTurbo\Transactiontype');
    }
}
