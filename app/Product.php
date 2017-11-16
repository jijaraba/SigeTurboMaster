<?php

namespace SigeTurbo;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $primaryKey = 'idproduct';
    protected $fillable = ['name'];
    protected $hidden = ['created_at', 'updated_at'];
    protected $table = 'products';


}