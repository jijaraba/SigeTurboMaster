<?php

namespace SigeTurbo;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Routebyuser extends Model
{

    protected $primaryKey = 'idroutebyuser';
    protected $fillable = ['idroute', 'iduser'];
    protected $hidden = ['created_at', 'updated_at'];

    /**
     * Table Name
     * @var string
     */
    protected $table = 'routebyusers';

    /**
     * @return mixed
     */
    public function route()
    {
        return $this->belongsTo('SigeTurbo\Route');
    }

    /**
     * @return mixed
     */
    public function user()
    {
        return $this->belongsTo('SigeTurbo\User');
    }
}