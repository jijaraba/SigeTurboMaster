<?php

namespace SigeTurbo;

use Illuminate\Database\Eloquent\Model;

class Vouchertype extends Model
{
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
