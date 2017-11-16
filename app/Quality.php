<?php

namespace SigeTurbo;

use Illuminate\Database\Eloquent\Model;

class Quality extends Model
{
    protected $primaryKey = 'idquality';
    protected $fillable = ['name'];
    protected $hidden = ['created_at', 'updated_at'];
    /**
     * Table Name
     * @var string
     */
    protected $table = 'qualities';


    /**
     * @return mixed
     */
    public function inventories()
    {
        return $this->hasMany('SigeTurbo\Inventory', 'idquality', 'idquality');
    }
}
