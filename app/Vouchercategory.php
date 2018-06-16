<?php

namespace SigeTurbo;

use Illuminate\Database\Eloquent\Model;

class Vouchercategory extends Model
{

    const INVOICE = 1;
    const RECEIPT = 2;

    protected $primaryKey = 'idvouchercategory';
    protected $fillable = ['name', 'created_by', 'updated_by'];
    protected $hidden = ['created_at', 'updated_at'];
    /**
     * Table Name
     * @var string
     */
    protected $table = 'vouchercategories';
}
