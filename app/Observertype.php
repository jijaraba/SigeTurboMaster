<?php

namespace SigeTurbo;

use Illuminate\Database\Eloquent\Model;

class Observertype extends Model
{

    protected $primaryKey = 'idobservertype';
    protected $fillable = ['name'];
    protected $hidden = ['created_at', 'updated_at'];

    /**
     * Table Name
     * @var string
     */
    protected $table = 'observertypes';

    /**
     * @return mixed
     */
    public function observer()
    {
        return $this->hasMany('SigeTurbo\Observer', 'idobservertype', 'idobservertype');
    }

}