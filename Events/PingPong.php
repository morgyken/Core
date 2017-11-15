<?php

namespace Ignite\Core\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class PingPong implements ShouldBroadcast
{
    use SerializesModels, InteractsWithSockets;

    public $message;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->message  = "pusher message";
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return ['ping'];
    }
}
