<?php

namespace SigeTurbo\Events;

use Illuminate\Support\Facades\Auth;
use SigeTurbo\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;

class Stream extends Event implements ShouldBroadcastNow
{
    use SerializesModels;
    /**
     * @var
     */
    public $data;

    /**
     * Create a new event instance.
     * @param $data
     */
    public function __construct($data)
    {
        $user = getUser();
        $this->data = [
            'message' => "<div class='photo'><div><img src='" . getenv("ASSETS_SERVER") . "/img/users/" . $user->photo. "' alt='" . $user->firstname. "' title='" . $user->firstname . "'></div></div><div class='message'><span>". $user->firstname. " " . $data['description'] . " </span></div>"
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
