<?php

namespace SigeTurbo;

use Illuminate\Database\Eloquent\Model;

class Observer extends Model
{

    protected $primaryKey = 'idobserver';
    protected $fillable = ['idyear', 'idgroup', 'idobservertype', 'iduser', 'idteacher', 'observer', 'observed_at'];
    protected $hidden = ['created_at', 'updated_at'];

    /**
     * Table Name
     * @var string
     */
    protected $table = 'observers';

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
    public function group()
    {
        return $this->belongsTo('SigeTurbo\Group');
    }

    /**
     * @return mixed
     */
    public function observertype()
    {
        return $this->belongsTo('SigeTurbo\Observertype');
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
    public function teacher()
    {
        return $this->belongsTo('SigeTurbo\User');
    }

}