<?php

namespace SigeTurbo;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $primaryKey = 'idpackage';
    protected $fillable = ['idconcepttype', 'code', 'name', 'starts', 'ends', 'active', 'created_by', 'updated_by'];
    protected $hidden = ['created_at', 'updated_at'];
    /**
     * Table Name
     * @var string
     */
    protected $table = 'packages';

    /**
     * @return mixed
     */
    public function concepttype()
    {
        return $this->belongsTo('SigeTurbo\Concepttype');
    }

    /**
     * @return mixed
     */
    public function costpackages()
    {
        return $this->hasMany('SigeTurbo\Costpackage', 'idpackage', 'idpackage');
    }
}
