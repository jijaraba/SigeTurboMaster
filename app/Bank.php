<?php

namespace SigeTurbo;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    protected $primaryKey = 'idbank';
    protected $fillable = ['name'];
    protected $hidden = ['created_at', 'updated_at'];
    /**
     * Table Name
     * @var string
     */
    protected $table = 'banks';


    /**
     * @return mixed
     */
    public function payment()
    {
        return $this->hasMany('SigeTurbo\Payment', 'idbank', 'idbank');
    }
}
