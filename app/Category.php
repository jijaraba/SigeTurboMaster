<?php

namespace SigeTurbo;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    const STUDENT = 13;
    const FATHER = 27;
    const MOTHER = 28;
    const ALUMNUS = 33;
    const PARENTS = [27,28,29];

    protected $primaryKey = 'idcategory';
    protected $fillable = ['name', 'description'];
    protected $hidden = ['created_at', 'updated_at'];
    /**
     * Table Name
     * @var string
     */
    protected $table = 'categories';


    /**
     * @return mixed
     */
    public function user()
    {
        return $this->hasMany('SigeTurbo\User', 'idcategory', 'idcategory');
    }

    /**
     * @return mixed
     */
    public function preregistration()
    {
        return $this->hasMany('SigeTurbo\Preregistration', 'idcategory', 'idcategory');
    }

}