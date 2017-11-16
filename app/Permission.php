<?php

namespace SigeTurbo;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    /**
     * Table Name
     * @var string
     */
    protected $table = 'permissions';

    /**
     * @return mixed
     */
    public function years()
    {
        return $this->belongsTo('SigeTurbo\Year');
    }

    /**
     * @return mixed
     */
    public function users()
    {
        return $this->belongsTo('SigeTurbo\User');
    }
}
