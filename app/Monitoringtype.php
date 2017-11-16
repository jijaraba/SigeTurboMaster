<?php

namespace SigeTurbo;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Monitoringtype extends Model
{

    protected $primaryKey = 'idmonitoringtype';
    protected $fillable = ['idyear', 'idperiod', 'idgroup', 'idsubject', 'idnivel', 'idmonitoringcategory', 'date', 'name', 'description', 'created_by','updated_by'];
    protected $hidden = ['created_at', 'updated_at'];
    /**
     * Table Name
     * @var string
     */
    protected $table = 'monitoringtypes';


    /**
     * @return mixed
     */
    public function year()
    {
        return $this->belongsTo('SigeTurbo\Year');
    }

    /**
     * @return mixed
     */
    public function period()
    {
        return $this->belongsTo('SigeTurbo\Period');
    }

    /**
     * @return mixed
     */
    public function group()
    {
        return $this->belongsTo('SigeTurbo\Group');
    }

    /**
     * @return mixed
     */
    public function suject()
    {
        return $this->belongsTo('SigeTurbo\Subject');
    }

    /**
     * @return mixed
     */
    public function nivel()
    {
        return $this->belongsTo('SigeTurbo\Nivel');
    }

    /**
     * @return mixed
     */
    public function monitoringcategory()
    {
        return $this->belongsTo('SigeTurbo\Monitoringcategory');
    }


    /**
     * @return mixed
     */
    public function monitoring()
    {
        return $this->hasMany('SigeTurbo\Monitoring', 'idmonitoringtype', 'idmonitoringtype');
    }

    /**
     * @return mixed
     */
    public function data()
    {
        return $this
            ->hasMany('SigeTurbo\Monitoring', 'idmonitoringtype', 'idmonitoringtype')
            ->select(DB::raw("idmonitoringtype,idmonitoring,CASE WHEN (rating BETWEEN 0.00 AND 2.99) THEN 'DP' ELSE CASE WHEN (rating BETWEEN 3.00 AND 3.70) THEN 'DB' ELSE CASE WHEN (rating BETWEEN 3.71 AND 4.30) THEN 'DA' ELSE CASE WHEN (rating BETWEEN 4.31 AND 5.00) THEN 'DS' END END END END label, CASE WHEN (rating BETWEEN 0.00 AND 2.99) THEN '#ED5565' ELSE CASE WHEN (rating BETWEEN 3.00 AND 3.70) THEN '#FC6E51' ELSE CASE WHEN (rating BETWEEN 3.71 AND 4.30) THEN '#2f9da3' ELSE CASE WHEN (rating BETWEEN 4.31 AND 5.00) THEN '#A0D468' END END END END color,CASE WHEN (rating BETWEEN 0.00 AND 2.99) THEN '#DA4453' ELSE CASE WHEN (rating BETWEEN 3.00 AND 3.70) THEN '#E9573F' ELSE CASE WHEN (rating BETWEEN 3.71 AND 4.30) THEN '#3ababa' ELSE CASE WHEN (rating BETWEEN 4.31 AND 5.00) THEN '#8CC152' END END END END highlight,COUNT(*) value"))
            ->groupBy('idmonitoringtype', 'label');
    }

    /**
     * @return mixed
     */
    public function monitorings()
    {
        return $this->morphMany('SigeTurbo\Monitoring', 'monitoringable');
    }

    /**
     * @return mixed
     */
    public function monitoringtypeindicator()
    {
        return $this->hasMany('SigeTurbo\Monitoringtypeindicator', 'idmonitoringtype', 'idmonitoringtype');
    }


}