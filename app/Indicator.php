<?php

namespace SigeTurbo;

use Illuminate\Database\Eloquent\Model;

class Indicator extends Model
{

    protected $primaryKey = 'idindicator';
    protected $fillable = ['idachievement', 'consecutive', 'idindicatortype', 'indicator','idindicatorcategory'];
    protected $hidden = ['created_at', 'updated_at'];
    /**
     * Table Name
     * @var string
     */
    protected $table = 'indicators';


    /**
     * @return mixed
     */
    public function achievement()
    {
        return $this->hasMany('SigeTurbo\Achievement', 'idachievement', 'idachievement');
    }

    /**
     * @return mixed
     */
    public function indicatortype()
    {
        return $this->hasMany('SigeTurbo\Indicatortype', 'idindicatortype', 'idindicatortype');
    }

    /**
     * @return mixed
     */
    public function indicatorcategory()
    {
        return $this->hasMany('SigeTurbo\Indicatorcategory', 'idindicatorcategory', 'idindicatorcategory');
    }

    /**
     * @return mixed
     */
    public function monitoringtypeindicator()
    {
        return $this->hasMany('SigeTurbo\Monitoringtypeindicator', 'idindicator', 'idindicator');
    }

}