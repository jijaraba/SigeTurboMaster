<?php

namespace SigeTurbo;

use Illuminate\Database\Eloquent\Model;

class Concepttype extends Model
{
    protected $primaryKey = 'idconcepttype';
    protected $fillable = ['name', 'prefix'];
    protected $hidden = ['created_at', 'updated_at'];
    /**
     * Table Name
     * @var string
     */
    protected $table = 'concepttypes';

    /**
     * @return mixed
     */
    public function costs()
    {
        return $this->hasMany('SigeTurbo\Cost', 'idconcepttype', 'idconcepttype');
    }

    /**
     * @return mixed
     */
    public function transactions()
    {
        return $this->hasMany('SigeTurbo\Package', 'idaccounttype', 'idaccounttype');
    }
}
