<?php

namespace SigeTurbo;

use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    protected $primaryKey = 'idasset';
    protected $fillable = ['idassetcategory','idprovider','code','name','manufacturer','model','serial','description','cost','acquired','created_by','updated_by'];
    protected $hidden = ['created_at', 'updated_at'];
    /**
     * Table Name
     * @var string
     */
    protected $table = 'assets';

    /**
     * @return mixed
     */
    public function assetcategory()
    {
        return $this->belongsTo('SigeTurbo\Assetcategory');
    }

    /**
     * @return mixed
     */
    public function provider()
    {
        return $this->belongsTo('SigeTurbo\Provider');
    }

    /**
     * @return mixed
     */
    public function inventories()
    {
        return $this->hasMany('SigeTurbo\Inventory', 'idasset', 'idasset');
    }

}
