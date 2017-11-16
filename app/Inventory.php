<?php

namespace SigeTurbo;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $primaryKey = 'idinventory';
    protected $fillable = ['idinventorytype', 'idasset', 'idubication', 'idquality','iduser','observation','verified_by'];
    protected $hidden = ['created_at', 'updated_at'];
    /**
     * Table Name
     * @var string
     */
    protected $table = 'inventories';


    /**
     * @return mixed
     */
    public function inventorytype()
    {
        return $this->belongsTo('SigeTurbo\Inventorytype');
    }

    /**
     * @return mixed
     */
    public function asset()
    {
        return $this->belongsTo('SigeTurbo\Asset');
    }

    /**
     * @return mixed
     */
    public function ubication()
    {
        return $this->belongsTo('SigeTurbo\Ubication');
    }

    /**
     * @return mixed
     */
    public function quality()
    {
        return $this->belongsTo('SigeTurbo\Quality');
    }


    /**
     * @return mixed
     */
    public function user()
    {
        return $this->belongsTo('SigeTurbo\User');
    }
    

}
