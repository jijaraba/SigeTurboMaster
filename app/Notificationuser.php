<?php

namespace SigeTurbo;

use Illuminate\Database\Eloquent\Model;

class Notificationuser extends Model
{

    protected $primaryKey = 'idnotificationuser';
    protected $fillable = ['idnotification', 'iduser', 'state'];
    protected $hidden = ['created_at', 'updated_at', 'delete_at'];
    /**
     * Table Name
     * @var string
     */
    protected $table = 'notificationusers';


    /**
     * @param $iduser
     * @param string $state
     * @return mixed
     */
    public static function search($iduser, $state = 'Unread')
    {
        return static::whereRaw('iduser = ? AND state = ?', array($iduser, $state))->get();
    }

    /**
     * @param $iduser
     * @param string $state
     * @return mixed
     */
    public static function count($iduser, $state = 'Unread')
    {
        return static::whereRaw('iduser = ? AND state = ?', array($iduser, $state))->get()->count();
    }

    /**
     * @return mixed
     */
    public function notification()
    {
        return $this->belongsTo('SigeTurbo\Notification');
    }

    /**
     * @return mixed
     */
    public function user()
    {
        return $this->belongsTo('SigeTurbo\User');
    }

}