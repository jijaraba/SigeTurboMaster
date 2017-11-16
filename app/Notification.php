<?php

namespace SigeTurbo;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{

    protected $primaryKey = 'idnotification';
    protected $fillable = ['name', 'description', 'starts', 'ends', 'flag'];
    protected $hidden = ['created_at', 'updated_at'];
    /**
     * Table Name
     * @var string
     */
    protected $table = 'notifications';

    /**
     * @return mixed
     */
    public function notificationusers()
    {
        return $this->hasMany('SigeTurbo\Notificationuser', 'idnotification', 'idnotification');
    }

}