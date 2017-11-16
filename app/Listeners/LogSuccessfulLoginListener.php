<?php

namespace SigeTurbo\Listeners;

use Carbon\Carbon;
use Illuminate\Auth\Events\Login;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Lang;
use Parse\ParseClient;
use Parse\ParseException;
use Parse\ParseUser;
use SigeTurbo\Events\Stream;
use SigeTurbo\User;

class LogSuccessfulLoginListener
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
        $this->request = $request;
    }

    /**
     * Handle the event.
     * @param Login $event
     */
    public function handle(Login $event)
    {

        //Update Last Session
        $user = User::find($event->user->iduser);
        $user->last_session = Carbon::now();
        $user->email_confirmed = "1";
        if ($user->api_token == null) {
            $user->api_token = str_random(60);
        }
        $user->save();

        //Define Role Session
        $role = explode(",", $user->role);
        $user->role_selected = $role[0];
        $user->save();

        //Event
        event(new Stream(['description' => Lang::get('sige.LoginStream')]));
    }
}
