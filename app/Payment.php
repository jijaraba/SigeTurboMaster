<?php

namespace SigeTurbo;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{

    protected $primaryKey = 'idpayment';
    protected $fillable = ['idpaymenttype', 'idpackage', 'idbank', 'idfamily', 'iduser', 'method', 'concept1', 'value1', 'date1', 'observation1', 'concept2', 'value2', 'date2', 'observation2', 'concept3', 'value3', 'date3', 'observation3', 'concept4', 'value4', 'date4', 'observation4', 'observation', 'ispayment', 'approved', 'realdate', 'voucher', 'transaccionId', 'uuid', 'transaccionTNS', 'hash', 'realValue', 'payment_at', 'payment_by', 'created_by', 'updated_by', 'payment_at', 'verified_by'];
    protected $hidden = ['created_at', 'updated_at'];

    /**
     * Table Name
     * @var string
     */
    protected $table = 'payments';

    /**
     * @return mixed
     */
    public function family()
    {
        return $this->belongsTo('SigeTurbo\Family');
    }

    /**
     * @return mixed
     */
    public function transactions()
    {
        return $this->hasMany('SigeTurbo\Transaction', 'idpayment', 'idpayment')
            ->select('transactions.*', 'vouchertypes.code AS vouchertype', 'accounttypes.code AS accounttype', 'costcenters.code AS costcenter')
            ->join('vouchertypes', function ($join) {
                $join->on('vouchertypes.idvouchertype', '=', 'transactions.idvouchertype');
            })
            ->join('accounttypes', function ($join) {
                $join->on('accounttypes.idaccounttype', '=', 'transactions.idaccounttype');
            })
            ->join('costcenters', function ($join) {
                $join->on('costcenters.idcostcenter', '=', 'transactions.idcostcenter');
            });
    }

}