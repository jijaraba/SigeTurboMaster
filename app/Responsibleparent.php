<?php

namespace SigeTurbo;

use Illuminate\Database\Eloquent\Model;

class Responsibleparent extends Model
{

    protected $primaryKey = 'idresponsibleparent';
    protected $fillable = ['iduser', 'responsible','created_by','updated_by'];
    protected $hidden = ['created_at', 'updated_at'];

    /**
     * Table Name
     * @var string
     */
    protected $table = 'responsibleparents';

    /**
     * @return mixed
     */
    public function user()
    {
        return $this->belongsTo('SigeTurbo\User');
    }
}