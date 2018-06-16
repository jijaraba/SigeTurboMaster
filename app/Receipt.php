<?php

namespace SigeTurbo;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Receipt extends Model
{
    protected $primaryKey = 'idreceipt';
    protected $fillable = ['idvouchertype', 'document', 'date', 'value', 'realdate', 'description', 'created_by', 'updated_by'];
    protected $hidden = ['created_at', 'updated_at'];
    /**
     * Table Name
     * @var string
     */
    protected $table = 'receipts';

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
    public function receiptpayments()
    {
        return $this->hasMany('SigeTurbo\Receiptpayment', 'idreceipt', 'idreceipt')
            ->select('receiptpayments.*', 'payments.*', 'receipts.document', DB::raw('MONTHNAME(payments.realdate) AS month_name'), 'receiptpayments.value AS receipt_realvalue')
            ->join('payments', function ($join) {
                $join
                    ->on('payments.idpayment', '=', 'receiptpayments.idpayment');
            })
            ->join('receipts', function ($join) {
                $join
                    ->on('receipts.idreceipt', '=', 'receiptpayments.idreceipt');
            })
            ->orderBy('payments.realdate', 'DESC');
    }

    /**
     * @return mixed
     */
    public function accountingentries()
    {
        return $this->hasMany('SigeTurbo\Accountingentry', 'idreceipt', 'idreceipt');
    }

}
