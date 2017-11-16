<?php

namespace SigeTurbo\Repositories\Notification;

interface NotificationRepositoryInterface
{
    public function all();
    public function find($idnotification);

}