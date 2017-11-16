<?php

namespace SigeTurbo;

use Illuminate\Database\Eloquent\Model;

class Origeninformation extends Model
{
    protected $primaryKey = 'idorigeninformation';
    protected $fillable = ['iduser', 'idlanguage', 'idcountry'];
    protected $hidden = ['created_at', 'updated_at'];
    /**
     * Table Name
     * @var string
     */
    protected $table = 'origeninformations';


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
    public function language()
    {
        return $this->belongsTo('SigeTurbo\Language');
    }

    /**
     * @return mixed
     */
    public function country()
    {
        return $this->belongsTo('SigeTurbo\Country');
    }
}
