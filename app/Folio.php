<?php

namespace SigeTurbo;

use Illuminate\Database\Eloquent\Model;

class Folio extends Model
{

    protected $primaryKey = 'idfolio';
    protected $fillable = ['idyear','iduser','idtypepromotion','folio','observation'];
    protected $hidden = ['created_at', 'updated_at'];
    /**
     * Table Name
     * @var string
     */
    protected $table = 'folios';


    /**
     * @return mixed
     */
    public function year()
    {
        return $this->belongsTo('SigeTurbo\Year');
    }

    /**
     * @return mixed
     */
    public function user()
    {
        return $this->belongsTo('SigeTurbo\User');
    }

    /**
     * @return mixed
     */
    public function typeofpromotion()
    {
        return $this->belongsTo('SigeTurbo\Typeofpromotion');
    }

}