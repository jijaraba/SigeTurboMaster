<?php

namespace SigeTurbo\Jobs;

use SigeTurbo\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ParentPaymentJob extends Job implements ShouldQueue
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
        $this->data = $data;
    }

    /**
     * Execute the job.
     * @return void
     */
    public function handle()
    {
        $data = $this->data;
        Mail::send('emails.parents.payment', $this->data, function ($message) use ($data) {
            $message
                ->to($data["user"]["email"], $data['user']["firstname"])
                ->subject(Lang::get('sige.PaymentRespond'));
        });
    }
}
