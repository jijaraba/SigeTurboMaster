<?php

namespace SigeTurbo;

use Illuminate\Database\Eloquent\Model;

class Groupdirector extends Model
{

    protected $primaryKey = 'idgroupdirector';
    protected $fillable = ['idyear', 'idgroup', 'iduser'];
    protected $hidden = ['created_at', 'updated_at'];
    /**
     * Table Name
     * @var string
     */
    protected $table = 'groupdirectors';

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
    public function group()
    {
        return $this->belongsTo('SigeTurbo\Group');
    }


    /**
     * @return mixed
     */
    public function user()
    {
        return $this->belongsTo('SigeTurbo\User');
    }

}
