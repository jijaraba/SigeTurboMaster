<?php

namespace SigeTurbo;


use Illuminate\Database\Eloquent\Model;

class Monitoring extends Model
{

    protected $primaryKey = 'idmonitoring';
    protected $fillable = ['idprovenance', 'idyear', 'idperiod', 'idgroup', 'idsubject', 'idnivel', 'iduser', 'idmonitoringtype', 'rating', 'observation', 'created_by', 'updated_by'];
    protected $hidden = ['created_at', 'updated_at'];
    /**
     * Table Name
     * @var string
     */
    protected $table = 'monitorings';


    /**
     * @return mixed
     */
    public function provenance()
    {
        return $this->belongsTo('SigeTurbo\Provenance');
    }

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
    public function subject()
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
    public function user()
    {
        return $this->belongsTo('SigeTurbo\User');
    }

    /**
     * @return mixed
     */
    public function monitoringtype()
    {
        return $this->belongsTo('SigeTurbo\Monitoringtype');
    }

    public function monitoringable()
    {
        return $this->morphTo();
    }

}