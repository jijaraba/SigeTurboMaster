<?php

namespace SigeTurbo;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Purchase extends Model
{

    protected $primaryKey = 'idpurchase';
    protected $fillable = ['code', 'name', 'idprovider', 'idstatuspurchase', 'days', 'delivery', 'budget', 'iduser', 'date', 'discount', 'leadtime','observation'];
    protected $hidden = ['created_at', 'updated_at'];
    protected $table = 'purchases';


    /**
     * @return mixed
     */
    public function details()
    {
        return $this->hasMany('SigeTurbo\Detail', 'idpurchase', 'idpurchase')
            ->select('details.*', 'products.vat')
            ->join('products', function ($join) {
                $join
                    ->on('products.idproduct', '=', 'details.idproduct');
            });
    }

    /**
     * @return mixed
     */
    public function evaluations()
    {
        return $this->hasMany('SigeTurbo\Evaluationpurchase', 'idpurchase', 'idpurchase');
    }

    /**
     * @return mixed
     */
    public function statuspurchases()
    {
        return $this->belongsTo('SigeTurbo\Statuspurchase');
    }
    /**
     * @return mixed
     */
    public function providers()
    {
        return $this->belongsTo('SigeTurbo\Provider');
    }


}