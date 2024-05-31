<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SendMessage implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */

    public $profile;
    public $message;
    public $html;
    public $messageHtml;

    public function __construct($profile, $message, $html, $messageHtml)
    {
        $this->profile = $profile;
        $this->message = $message;
        $this->html = $html;
        $this->messageHtml = $messageHtml;
    }


    public function broadcastOn()
    {
        return new Channel('chat-message.'. $this->profile);
    }
}
