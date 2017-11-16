<?php namespace SigeTurbo\Queue;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Lang;

class MonitoringService
{

    /**
     * @param $job
     * @param $data
     * @internal param $data
     */
    public function fire($job, $data)
    {
        Mail::send('emails.monitoring', $data, function ($message) use ($data) {
            $message
                ->to($data["user"]["email"], $data['user']["firstname"])
                ->subject(Lang::get('sige.Monitoring'));
        });
        $job->delete();
    }
}