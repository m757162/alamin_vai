<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ChatEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private $message;
    private $sender_id;
    private $type;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($message, $sender_id, $type)
    {
        $this->message = $message;
        $this->sender_id = $sender_id;
        $this->type = $type;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('chat');
    }

    // public function broadcastAs()
    // {
    //     return 'message';
    // }

    public function broadcastWith()
    {
        return [
            'type' => $this->type,
            'client_id' => $this->sender_id,
            'message' => $this->message,
        ];
    }
}
