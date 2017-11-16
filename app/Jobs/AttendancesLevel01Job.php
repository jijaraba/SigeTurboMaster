<?php

namespace SigeTurbo\Jobs;

use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;
use SigeTurbo\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class AttendancesLevel01Job extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;
    /**
     * @var
     */
    private $data;

    /**
     * Create a new job instance.
     *
     * @param $data
     */
    public function __construct($data)
    {
        //
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $data = $this->data;
        Mail::send('emails.attendances.attendances_level01', $this->data, function ($message) use ($data) {
            $message
                ->to($data["user"]["email"], $data['user']["firstname"])
                ->subject(Lang::get('sige.AttendancesLevel01'));
        });
    }
}
