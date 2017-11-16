<?php

namespace SigeTurbo;

use Illuminate\Database\Eloquent\Model;

class Typeofpromotion extends Model
{

    protected $primaryKey = 'idtypeofpromotion';
    protected $fillable = ['name', 'active'];
    protected $hidden = ['created_at', 'updated_at'];
    /**
     * Table Name
     * @var string
     */
    protected $table = 'typeofpromotions';

    /**
     * @return mixed
     */
    public function folios()
    {
        return $this
            ->hasMany('SigeTurbo\Folio', 'idtypepromotion', 'idtypepromotion');
    }


}