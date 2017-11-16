<?php

namespace SigeTurbo\Listeners;

use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Auth\Events\Attempting;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;

class PasswordResetSuccessfulListener
{
    /**
     * @var Request
     */
    private $request;

    /**
     * Create the event listener.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        //
        $this->request = $request;
    }

    /**
     * Handle the event.
     *
     * @param  CanResetPassword  $event
     * @return void
     */
    public function handle(ResetsPasswords $event)
    {
        dd($event);
        exit();
    }
}
