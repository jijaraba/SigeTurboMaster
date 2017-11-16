<?php

namespace SigeTurbo\Listeners;

use Illuminate\Auth\Events\Logout;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Lang;
use SigeTurbo\Events\Stream;

class LogSuccessfulLogoutListener
{
    /**
     * Create the event listener.
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     * @param  Logout  $event
     * @return void
     */
    public function handle(Logout $event)
    {
        //Event
        event(new Stream(['description' => Lang::get('sige.LogoutStream')]));
    }
}
