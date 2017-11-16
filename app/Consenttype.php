<?php

namespace SigeTurbo;

use Illuminate\Database\Eloquent\Model;

class Consenttype extends Model
{
    protected $primaryKey = 'idconsenttype';
    protected $fillable = ['name'];
    protected $hidden = ['created_at', 'updated_at'];
    /**
     * Table Name
     * @var string
     */
    protected $table = 'consenttypes';


    /**
     * @return mixed
     */
    public function consent()
    {
        return $this->hasMany('SigeTurbo\Consent', 'idconsenttype', 'idconsenttype');
    }
}