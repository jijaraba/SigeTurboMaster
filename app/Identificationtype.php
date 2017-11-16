<?php

namespace SigeTurbo;

use Illuminate\Database\Eloquent\Model;

class Identificationtype extends Model
{

    protected $primaryKey = 'ididentificationtype';
    protected $fillable = ['name'];
    protected $hidden = ['created_at', 'updated_at'];

    /**
     * Table Name
     * @var string
     */
    protected $table = 'identificationtypes';

    /**
     * @return mixed
     */
    public function preregistration()
    {
        return $this->hasMany('SigeTurbo\Preregistration', 'idpreregistration', 'idpreregistration');
    }

    /**
     * @return mixed
     */
    public function visitors()
    {
        return $this->hasMany('SigeTurbo\Visitor', 'ididentificationtype', 'ididentificationtype');
    }

    /**
     * @return mixed
     */
    public function identifications()
    {
        return $this->hasMany('SigeTurbo\Identification', 'ididentificationtype', 'ididentificationtype');
    }

}