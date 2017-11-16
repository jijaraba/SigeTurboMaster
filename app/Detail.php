<?php

namespace SigeTurbo;

use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{

    protected $primaryKey = 'iddetail';
    protected $fillable = ['idpurchase', 'idproduct', 'quantity', 'cost', 'total'];
    protected $hidden = ['created_at', 'updated_at'];
    protected $table = 'details';


    /**
     * @return mixed
     */
    public function purchases()
    {
        return $this->belongsTo('SigeTurbo\Purchase');
    }

}