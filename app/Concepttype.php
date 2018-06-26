<?php

namespace SigeTurbo;

use Illuminate\Database\Eloquent\Model;

class Concepttype extends Model
{
    const ENROLLMENT = 2;
    const PENSION = 3;
    const EXTRACURRICULAR = 4;
    const NIVELATION = 5;
    const VALIDATION = 6;
    const OTHERS = 7;

    protected $primaryKey = 'idconcepttype';
    protected $fillable = ['name', 'prefix', 'enable'];
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
