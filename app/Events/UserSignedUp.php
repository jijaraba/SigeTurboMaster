<?php

namespace SigeTurbo\Events;

use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use SigeTurbo\Events\Event;
use Illuminate\Queue\SerializesModels;

class UserSignedUp extends Event implements ShouldBroadcastNow
{
    use SerializesModels;
    /**
     * @var
     */
    public $data;

    /**
     * Create a new event instance.
     */
    public function __construct()
    {
        $this->data = [
            'power' => 12,
            'username' => 'jijaraba'
        ];
    }


    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {

        return ['sigeturbo-channel'];
    }
}
