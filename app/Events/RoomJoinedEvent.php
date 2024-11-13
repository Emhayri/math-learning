<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\ShouldBroadcastNow;
use Illuminate\Queue\SerializesModels;

class RoomJoinedEvent implements ShouldBroadcastNow
{
    use InteractsWithSockets, SerializesModels;

    public $username;
    public $code;

    public function __construct($username, $code)
    {
        $this->username = $username;
        $this->code = $code;
    }

    public function broadcastOn()
    {
        return new Channel('room-channel');
    }

    public function broadcastAs()
    {
        return 'room.joined';
    }
}
