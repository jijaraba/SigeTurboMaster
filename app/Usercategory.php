<?php

namespace SigeTurbo;

use Illuminate\Database\Eloquent\Model;

class Usercategory extends Model
{
    protected $primaryKey = 'idusercategory';
    protected $fillable = ['name'];
    protected $hidden = ['created_at', 'updated_at'];
    /**
     * Table Name
     * @var string
     */
    protected $table = 'usercategories';


    /**
     * @return mixed
     */
    public function user()
    {
        return $this->hasMany('SigeTurbo\User', 'idusercategory', 'idusercategory');
    }
}