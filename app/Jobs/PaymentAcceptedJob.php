<?php

namespace SigeTurbo\Jobs;

use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;
use SigeTurbo\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class PaymentAcceptedJob extends Job implements ShouldQueue
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
        
        if($data["payment"]["approved"] == "A") {
            $title = Lang::get('sige.PaymentAcceptedTitle');
        } elseif ($data["payment"]["approved"] == "R") {
            $title = Lang::get('sige.PaymentRejectedTitle');
        } elseif ($data["payment"]["approved"] == "P") {
            $title = Lang::get('sige.PaymentPendingTitle');
        }  elseif ($data["payment"]["approved"] == "N") {
            $title = Lang::get('sige.PaymentNotProcessedTitle');
        }

        Mail::send('emails.payment.accepted', $this->data, function ($message) use ($data, $title) {
            $message
                ->to($data["user"]["email"], $data['user']["firstname"])
                ->subject($title);
        });
    }
}
