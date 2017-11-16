<?php namespace SigeTurbo\Queue;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Lang;

class MeasurementService
{

    /**
     * @param $job
     * @param $user
     * @internal param $data
     */
    public function fire($job, $user)
    {
        Mail::send('emails.welcome', $user, function ($message) use ($user) {
            $message
                ->to($user['email'], $user['firstname'])
                ->subject(Lang::get('sige.MeasurementSigeTurbo'));
        });
        $job->delete();
    }
}
