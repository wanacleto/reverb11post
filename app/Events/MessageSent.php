<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;

class MessageSent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public $user;

    public function __construct($message, $user)
    {
       
        $this->message = $message;
        $this->user = $user;
    }

    public function broadcastOn()
    {
        //dd('broadcastOn');
        return new Channel('chat');
    }
    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function broadcastAs()
    {
        // dd('create2');
        return 'create2';
    }

    public function broadcastWith()
    {
        // dd( $this->message,  $this->user);
        return [
            'message' => $this->message,
            'user' => $this->user,
            'timestamp' => now()->toTimeString()
        ];
    }
}
