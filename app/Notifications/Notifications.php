<?php

namespace SigeTurbo\Notifications;

use Illuminate\Support\Facades\Auth;
use SigeTurbo\Notificationuser;
use SigeTurbo\Notification;

class Notifications
{

    public static function setNotification($title, $message, $starts, $ends, $flag = 1)
    {
        
        //Create Notification
        $notification = Notification::create([
            'name' => $title,
            'description' => $message,
            'starts' => $starts,
            'ends' => $ends,
            'flag' => $flag,
        ]);

        //Create User Notificatios
        Notificationuser::create([
            'idnotification' => $notification->idnotification,
            'iduser' => getUser()->iduser,
            'state' => 'Unread'
        ]);


    }

}