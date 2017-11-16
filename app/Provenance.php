<?php

namespace SigeTurbo;

use Illuminate\Database\Eloquent\Model;

class Provenance extends Model
{

    protected $primaryKey = 'idprovenance';
    protected $fillable = ['name'];
    protected $hidden = ['created_at', 'updated_at'];

    /**
     * Table Name
     * @var string
     */
    protected $table = 'provenances';

    /**
     * @return mixed
     */
    public function quantitativerecoveryfinalarea()
    {
        return $this->hasMany('SigeTurbo\Quantitativerecoveryfinalarea', 'idprovenance', 'idprovenance');
    }

    /**
     * @return mixed
     */
    public function qualitativerecoveryfinalarea()
    {
        return $this->hasMany('SigeTurbo\Qualitativerecoveryfinalarea', 'idprovenance', 'idprovenance');
    }

    /**
     * @return mixed
     */
    public function monitoring()
    {
        return $this->hasMany('SigeTurbo\Monitoring', 'idprovenance', 'idprovenance');
    }

}