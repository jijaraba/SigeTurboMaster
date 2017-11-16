<?php

namespace SigeTurbo;

use Illuminate\Database\Eloquent\Model;

class Inventorytype extends Model
{
    protected $primaryKey = 'idinventorytype';
    protected $fillable = ['name','starts','ends'];
    protected $hidden = ['created_at', 'updated_at'];
    /**
     * Table Name
     * @var string
     */
    protected $table = 'inventorytypes';


    /**
     * @return mixed
     */
    public function indicator()
    {
        return $this->hasMany('SigeTurbo\Inventory', 'idinventorytype', 'idinventorytype');
    }
}
