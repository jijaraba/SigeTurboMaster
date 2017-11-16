<?php

namespace SigeTurbo;

use Illuminate\Database\Eloquent\Model;

class Qualitativerecoveryfinalarea extends Model
{
    protected $primaryKey = 'idqualitativerecoveryfinalarea';
    protected $fillable = ['idyear', 'idprovenance', 'idgroup', 'idarea', 'iduser', 'idteacher', 'idassessment', 'act', 'observation', 'recovery_at', 'created_by', 'updated_by'];
    protected $hidden = ['created_at', 'updated_at'];
    /**
     * Table Name
     * @var string
     */
    protected $table = 'qualitativerecoveryfinalareas';

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
    public function provenance()
    {
        return $this->belongsTo('SigeTurbo\Provenance');
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
    public function area()
    {
        return $this->belongsTo('SigeTurbo\Area');
    }

    /**
     * @return mixed
     */
    public function teacher()
    {
        return $this->belongsTo('SigeTurbo\User');
    }

    /**
     * @return mixed
     */
    public function user()
    {
        return $this->belongsTo('SigeTurbo\User');
    }
}