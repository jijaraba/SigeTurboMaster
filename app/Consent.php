<?php

namespace SigeTurbo;

use Illuminate\Database\Eloquent\Model;

class Consent extends Model
{
    protected $primaryKey = 'idconsent';
    protected $fillable = ['iduser', 'idconsenttype', 'path'];
    protected $hidden = ['created_at', 'updated_at'];
    /**
     * Table Name
     * @var string
     */
    protected $table = 'consents';

    /**
     * @return mixed
     */
    public function users()
    {
        return $this->belongsTo('SigeTurbo\User');
    }

    /**
     * @return mixed
     */
    public function consenttypes()
    {
        return $this->belongsTo('SigeTurbo\Consenttype');
    }
}