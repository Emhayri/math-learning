<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Queue\SerializesModels;

class RoomLeftEvent implements ShouldBroadcastNow
{
    use InteractsWithSockets, SerializesModels;

    public $username;
    public $code;
    public $role;

    public function __construct($username, $code, $role)
    {
        $this->username = $username;
        $this->code = $code;
        $this->role = $role;
    }

    public function broadcastOn()
    {
        return new Channel('room-channel');
    }

    public function broadcastAs()
    {
        return 'room.left';
    }
}
