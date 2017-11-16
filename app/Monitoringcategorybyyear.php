<?php

namespace SigeTurbo;

use Illuminate\Database\Eloquent\Model;

class Monitoringcategorybyyear extends Model
{

    protected $primaryKey = 'idmonitoringcategorybyyear';
    protected $fillable = ['idyear', 'idsubject', 'idmonitoringcategorybyyear','idmonitoringcategory', 'percent'];
    protected $hidden = ['created_at', 'updated_at'];
    /**
     * Table Name
     * @var string
     */
    protected $table = 'monitoringcategorybyyears';


    /**
     * @return mixed
     */
    public function year()
    {
        return $this->belongsTo('Year');
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
    public function monitoringcategory()
    {
        return $this->belongsTo('SigeTurbo\Monitoringcategory');
    }
}