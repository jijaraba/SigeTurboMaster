<?php namespace SigeTurbo\Queue;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Lang;

class InstructiveService
{

    /**
     * @param $job
     * @param $user
     * @internal param $data
     */
    public function fire($job, $user)
    {
        Mail::send('emails.instructive', $user, function ($message) use ($user) {
            $message
                ->to($user['email'], $user['firstname'])
                ->subject(Lang::get('sige.InstructiveSigeTurbo'));
        });
        $job->delete();
    }
}
