<?php

namespace SigeTurbo;

use Illuminate\Database\Eloquent\Model;

class Identification extends Model
{

    protected $primaryKey = 'ididentification';
    protected $fillable = ['ididentificationtype', 'iduser', 'identification', 'expedition','date', 'created_by', 'updated_by'];
    protected $hidden = ['created_at', 'updated_at'];

    /**
     * Table Name
     * @var string
     */
    protected $table = 'identifications';

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
    public function identificationtype()
    {
        return $this->belongsTo('SigeTurbo\Identificationtype');
    }


}