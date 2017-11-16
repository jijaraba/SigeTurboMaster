<?php namespace SigeTurbo\Notifications;

use Illuminate\Support\ServiceProvider;

class NotificationsServiceProvider extends ServiceProvider {

    public function register()
    {
        $this->app->bind('notifications','Sige\Notifications\Notifications');
    }

}