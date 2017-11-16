<?php

namespace SigeTurbo\Alerts;

use SigeTurbo\Notificationuser;

class Alert
{

    /**
     * @param $iduser
     * @param string $state
     * @return mixed
     */
    public static function search($iduser, $state = 'Unread')
    {
        return Notificationuser::search($iduser, $state);
    }

    /**
     * @param $iduser
     * @param string $state
     * @return mixed
     */
    public static function count($iduser, $state = 'Unread')
    {
        return Notificationuser::count($iduser, $state);
    }


}