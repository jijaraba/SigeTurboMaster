<?php

namespace SigeTurbo;

use Illuminate\Database\Eloquent\Model;

class Vouchertype extends Model
{

    const RECEIPT_VIRTUAL = 1;
    const RECEIPT_MANUAL = 2;
    const INVOICE = 3;
    const ADVANCE = 4;

    protected $primaryKey = 'idvouchertype';
    protected $fillable = ['idvouchercategory', 'name'];
    protected $hidden = ['created_at', 'updated_at'];
    /**
     * Table Name
     * @var string
     */
    protected $table = 'vouchertypes';


    /**
     * @return mixed
     */
    public function transactions()
    {
        return $this->hasMany('SigeTurbo\Transaction', 'idvouchertype', 'idvouchertype');
    }
}
