<?php

namespace App\Events;

use App\Models\Message;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;

class BotReplyReceived implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets;

    public Message $message;

    /**
     * Create a new event instance.
     */
    public function __construct(Message $message)
    { 
        $this->message = $message;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('messages.' . $this->message->pair->user_id),
        ];
    }
}
