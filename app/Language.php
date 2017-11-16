<?php

namespace SigeTurbo;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{

    protected $primaryKey = 'idlanguage';
    protected $fillable = ['name'];
    protected $hidden = ['created_at', 'updated_at'];
    /**
     * Table Name
     * @var string
     */
    protected $table = 'languages';

    /**
     * @return mixed
     */
    public function origeninformation()
    {
        return $this->hasMany('SigeTurbo\Origeninformation', 'idlanguage', 'idlanguage');
    }


}