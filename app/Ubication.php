<?php

namespace SigeTurbo;

use Illuminate\Database\Eloquent\Model;

class Ubication extends Model
{
    protected $primaryKey = 'idubication';
    protected $fillable = ['iduser','sector','code','name','classroom','bookable','verified'];
    protected $hidden = ['created_at', 'updated_at'];
    /**
     * Table Name
     * @var string
     */
    protected $table = 'ubications';

    /**
     * Get Ubication Name With Code
     * @return string
     */
    public function getCodesAttribute()
    {
        return $this->code . " - " . $this->name . "";
    }

    /**
     * @return mixed
     */
    public function inventories()
    {
        return $this->hasMany('SigeTurbo\Inventory', 'idubication', 'idubication');
    }
}
