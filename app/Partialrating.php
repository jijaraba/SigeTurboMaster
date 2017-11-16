<?php

namespace SigeTurbo;

use Illuminate\Database\Eloquent\Model;

class Partialrating extends Model
{

    protected $primaryKey = 'idpartialrating';
    protected $fillable = ['idyear', 'idperiod', 'idgroup', 'idsubject', 'idnivel', 'iduser', 'rating', 'description', 'created_by', 'updated_by'];
    protected $hidden = ['created_at', 'updated_at'];
    /**
     * Table Name
     * @var string
     */
    protected $table = 'partialratings';

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

}