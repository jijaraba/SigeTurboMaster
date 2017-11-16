<?php namespace SigeTurbo\Queue;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Lang;

class TaskService
{

    /**
     * @param $job
     * @param $data
     */
    public function fire($job, $data)
    {
        Mail::send('emails.task', $data, function ($message) use ($data) {
            $message
                ->to($data["family"]["email"], $data['family']["firstname"])
                ->subject(Lang::get('sige.TaskNewSigeTurbo') . ' ~ ' . $data['group']['name'] . ' ~ ' . $data['subject']['name'] . ' ~ ' . 'SigeTurbo');
        });
        $job->delete();
    }
}