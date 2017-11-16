<?php

namespace SigeTurbo;

use Illuminate\Database\Eloquent\Model;

class Gender extends Model
{

    protected $primaryKey = 'idgender';
    protected $fillable = ['name'];
    protected $hidden = ['created_at', 'updated_at'];
    /**
     * Table Name
     * @var string
     */
    protected $table = 'genders';


    /**
     * @return mixed
     */
    public function user()
    {
        return $this->hasMany('SigeTurbo\User', 'idgender', 'idgender');
    }


}