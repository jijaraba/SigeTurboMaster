<?php

namespace SigeTurbo;

use Illuminate\Database\Eloquent\Model;

class Monitoringcategory extends Model
{

    protected $primaryKey = 'idmonitoringcategory';
    protected $fillable = ['name'];
    protected $hidden = ['created_at', 'updated_at'];
    /**
     * Table Name
     * @var string
     */
    protected $table = 'monitoringcategories';


    /**
     * @return mixed
     */
    public function monitoringtype()
    {
        return $this->hasMany('SigeTurbo\Monitoringtype', 'idmonitoringcategory', 'idmonitoringcategory');
    }

    /**
     * @return mixed
     */
    public function monitoringcategorybyyear()
    {
        return $this->hasMany('SigeTurbo\Monitoringcategorybyyear', 'idmonitoringcategory', 'idmonitoringcategory');
    }

}