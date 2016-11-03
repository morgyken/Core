<?php

namespace Ignite\Core\Events;

use Ignite\Messaging\Entities\Notification;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;

class BroadcastNotification implements ShouldQueue, ShouldBroadcast {

    use SerializesModels;

    /**
     * @var Notification
     */
    public $notification;

    public function __construct(Notification $notification) {
        $this->notification = $notification;
    }

    /**
     * Get the channels the event should broadcast on.
     * @return array
     */
    public function broadcastOn() {
        return ['dervis.notifications.' . $this->notification->user_id];
    }

}
