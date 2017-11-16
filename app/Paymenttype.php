<?php

namespace SigeTurbo;

use Illuminate\Database\Eloquent\Model;

class Paymenttype extends Model
{
    protected $primaryKey = 'idpaymenttype';
    protected $fillable = ['name'];
    protected $hidden = ['created_at', 'updated_at'];
    /**
     * Table Name
     * @var string
     */
    protected $table = 'paymenttypes';


    /**
     * @return mixed
     */
    public function payments()
    {
        return $this->hasMany('SigeTurbo\Payment', 'idpaymenttype', 'idpaymenttype');
    }
}
