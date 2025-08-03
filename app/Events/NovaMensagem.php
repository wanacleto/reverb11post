<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NovaMensagem implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public string $mensagem;

    public function __construct(string $mensagem)
    {
        $this->mensagem = $mensagem;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('chat');
    }

    public function broadcastAs()
    {
        return 'NovaMensagemRecebida';
    }
}
