<?php

namespace SigeTurbo\Listeners;

use Carbon\Carbon;
use Illuminate\Auth\Events\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
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
        $user->welcome_container = 1;
        $user->email_confirmed = "1";
        //Assign API Token
        if ($user->api_token == null) {
            $user->api_token = str_random(60);
        }
        //Change Global Token
        if ($user->last_change_token == null) {
            $user->last_change_token = Carbon::now();
            $user->token = str_random(70);
        } else {
            $end_date = Carbon::parse($user->last_change_token);
            if ($end_date->diffInDays(Carbon::now()) >= 60) {
                $user->last_change_token = Carbon::now();
                $user->token = str_random(70);
            }
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
