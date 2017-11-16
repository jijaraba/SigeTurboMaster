<?php

namespace SigeTurbo;

use Illuminate\Database\Eloquent\Model;

class Indicatortype extends Model
{

    protected $primaryKey = 'idindicatortype';
    protected $fillable = ['name'];
    protected $hidden = ['created_at', 'updated_at'];
    /**
     * Table Name
     * @var string
     */
    protected $table = 'indicatortypes';


    /**
     * @return mixed
     */
    public function indicator()
    {
        return $this->hasMany('SigeTurbo\Indicator', 'idindicatortype', 'idindicatortype');
    }

}