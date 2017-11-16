<?php

namespace SigeTurbo;

use Illuminate\Database\Eloquent\Model;

class Stratus extends Model
{

    const STRATUS_ONE = 1;
    const STRATUS_TWO = 2;
    const STRATUS_THREE = 3;
    const STRATUS_FOUR = 4;
    const STRATUS_FIVE = 5;


    protected $primaryKey = 'idstratus';
    protected $fillable = ['name'];
    protected $hidden = ['created_at', 'updated_at'];
    /**
     * Table Name
     * @var string
     */
    protected $table = 'stratuses';


    /**
     * @return mixed
     */
    public function user()
    {
        return $this->hasMany('SigeTurbo\User', 'idstratus', 'idstratus');
    }

}