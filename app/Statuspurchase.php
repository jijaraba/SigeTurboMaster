<?php

namespace SigeTurbo;

use Illuminate\Database\Eloquent\Model;

class Statuspurchase extends Model
{

    protected $primaryKey = 'idstatuspurchase';
    protected $fillable = ['name'];
    protected $hidden = ['created_at', 'updated_at'];
    protected $table = 'statuspurchases';

}