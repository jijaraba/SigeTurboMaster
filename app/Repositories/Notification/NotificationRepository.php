<?php

namespace SigeTurbo\Repositories\Notification;

use Illuminate\Support\Facades\Cache;
use SigeTurbo\Notification;

class NotificationRepository implements NotificationRepositoryInterface
{

    /**
     * Return all values
     * @return mixed
     */
    public function all()
    {
        return Cache::remember('notifications', 1440, function () {
            return Notification::all();
        });
    }

    /**
     * Find in Databases
     * @param $idnotification
     * @return mixed
     */
    public function find($idnotification)
    {
        return Notification::find($idnotification);
    }

}
