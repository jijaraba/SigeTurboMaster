<?php

namespace SigeTurbo;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    protected $primaryKey = 'idrequest';
    protected $fillable = ['iduser', 'request'];
    protected $hidden = ['created_at', 'updated_at'];
    /**
     * Table Name
     * @var string
     */
    protected $table = 'requests';

    /**
     * @return mixed
     */
    public function users()
    {
        return $this->belongsTo('SigeTurbo\User');
    }
}