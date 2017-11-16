<?php

namespace SigeTurbo;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{

    protected $primaryKey = 'idprovider';
    protected $fillable = ['nit','name','address','phone','fax','email','contact','web','observation','services','leadtime','paymentform','warranty','evaluation','date'];
    protected $hidden = ['created_at', 'updated_at'];
    protected $table = 'providers';


    /**
     * @return mixed
     */
    public function assets()
    {
        return $this->hasMany('SigeTurbo\Asset', 'idprovider', 'idprovider');
    }
    
    /**
     * @return mixed
     */
    public function evaluations()
    {
        return $this->hasMany('SigeTurbo\Purchase', 'idprovider', 'idprovider')
            ->select('purchases.*','evaluationpurchases.*')
            ->join('evaluationpurchases', function ($join) {
                $join
                    ->on('evaluationpurchases.idpurchase', '=', 'purchases.idpurchase');
            });
    }

    /**
     * @return mixed
     */
    public function purchases()
    {
        return $this->hasMany('SigeTurbo\Purchase', 'idprovider', 'idprovider')
            ->select('purchases.*')
            ->with('details');
    }

}