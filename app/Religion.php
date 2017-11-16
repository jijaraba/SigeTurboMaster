<?php

namespace SigeTurbo;

use Illuminate\Database\Eloquent\Model;

class Religion extends Model
{

    protected $primaryKey = 'idreligion';
    protected $fillable = ['name'];
    protected $hidden = ['created_at', 'updated_at'];
    /**
     * Table Name
     * @var string
     */
    protected $table = 'religions';


    /**
     * @return mixed
     */
    public function user()
    {
        return $this->hasMany('SigeTurbo\User', 'idreligion', 'idreligion');
    }

    /**
     * @return mixed
     */
    public function preregistration()
    {
        return $this->hasMany('SigeTurbo\Preregistration', 'idreligion', 'idreligion');
    }

}