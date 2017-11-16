<?php

namespace SigeTurbo;

use Illuminate\Database\Eloquent\Model;

class Productcategory extends Model
{

    protected $primaryKey = 'idproductcategory';
    protected $fillable = ['name'];
    protected $hidden = ['created_at', 'updated_at'];
    protected $table = 'productcategories';

}