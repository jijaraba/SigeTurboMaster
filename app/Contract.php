<?php

namespace SigeTurbo;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{

    protected $primaryKey = 'idcontract';
    protected $fillable = ['idyear', 'idperiod', 'idgroup', 'idsubject', 'idnivel', 'iduser', 'timeintensity'];
    protected $hidden = ['created_at', 'updated_at'];
    /**
     * Table Name
     * @var string
     */
    protected $table = 'contracts';


    /**
     * @return mixed
     */
    public function years()
    {
        return $this->belongsTo('SigeTurbo\Year');
    }

    /**
     * @return mixed
     */
    public function periods()
    {
        return $this->belongsTo('SigeTurbo\Period');
    }

    /**
     * @return mixed
     */
    public function groups()
    {
        return $this->belongsTo('SigeTurbo\Group');
    }

    /**
     * @return mixed
     */
    public function subjects()
    {
        return $this->belongsTo('SigeTurbo\Subject');
    }

    /**
     * @return mixed
     */
    public function nivels()
    {
        return $this->belongsTo('SigeTurbo\Nivel');
    }

    /**
     * @return mixed
     */
    public function users()
    {
        return $this->belongsTo('SigeTurbo\User');
    }

}