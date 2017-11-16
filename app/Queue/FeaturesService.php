<?php namespace SigeTurbo\Queue;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Lang;

class FeaturesService
{

    /**
     * @param $job
     * @param $user
     * @internal param $data
     */
    public function fire($job, $data)
    {
        Mail::send('emails.features', $data, function ($message) use ($data) {
            $message
                ->to($data['user']['email'], $data['user']['firstname'])
                ->subject(Lang::get('sige.Features'));
        });
        $job->delete();
    }
}