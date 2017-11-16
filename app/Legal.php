<?php

namespace SigeTurbo;

use Illuminate\Database\Eloquent\Model;

class Legal extends Model
{

    protected $primaryKey = 'idlegal';
    protected $fillable = ['idyear','resolution','curriculum'];
    protected $hidden = ['created_at', 'updated_at'];
    /**
     * Table Name
     * @var string
     */
    protected $table = 'legals';


    /**
     * @return mixed
     */
    public function year()
    {
        return $this->belongsTo('SigeTurbo\Year');
    }

}