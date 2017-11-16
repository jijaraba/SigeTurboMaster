<?php

namespace SigeTurbo;

use Illuminate\Database\Eloquent\Model;

class Monitoringtypeindicator extends Model
{

    protected $primaryKey = 'idmonitoringtypeindicator';
    protected $fillable = ['idmonitoringtype', 'idindicator'];
    protected $hidden = ['created_at', 'updated_at'];
    /**
     * Table Name
     * @var string
     */
    protected $table = 'monitoringtypeindicators';

    /**
     * @return mixed
     */
    public function monitoringtype()
    {
        return $this->hasMany('SigeTurbo\Monitoringtype', 'idmonitoringtype', 'idmonitoringtype');
    }

    /**
     * @return mixed
     */
    public function indicatortype()
    {
        return $this->hasMany('SigeTurbo\Indicator', 'idindicator', 'idindicator');
    }

}