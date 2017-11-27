<?php

namespace SigeTurbo\Listeners;

use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;
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
     * @param  Logout $event
     * @return void
     */
    public function handle(Logout $event)
    {
        //Log
        Log::info("Logout", ['username' => getUser()->username]);
        //Event
        event(new Stream(['description' => Lang::get('sige.LogoutStream')]));
    }
}
