<?php

namespace App\Livewire;

use Livewire\Component;
use App\Events\MessageSent;

class ChatComponent extends Component
{

    public $messages = [];
    public $newMessage = '';
    public $username = '';

    protected $listeners = ['novaMensagemRecebida' => 'receberMensagem'];

    public function receberMensagemm($payload)
    {
        // dd($payload);
        $this->messages[] = $payload;
    }

    public function receberMensagem($params)
    {
        $this->messages[] = [
            'text' => $params['text'],
            'user' => $params['user'],
            'timestamp' => $params['timestamp'],
        ];
    }

    public function mount()
    {
        $this->username = 'User_' . rand(1000, 9999);
    }

    public function sendMessage()
    {
        if (trim($this->newMessage) !== '') {
            $messageData = [
                'text' => $this->newMessage,
                'user' => $this->username,
                'timestamp' => now()->toTimeString()
            ];
    
            // Adiciona localmente apenas para o usuário que envia
            $this->messages[] = $messageData;
    
            // Dispara o evento somente para os OUTROS usuários (evita duplicar para si mesmo)
            broadcast(new MessageSent($this->newMessage, $this->username))->toOthers();
    
            $this->newMessage = '';
        }
    }
    
    public function sendMessagee()
    {
        if (trim($this->newMessage) !== '') {
            $messageData = [
                'text' => $this->newMessage,
                'user' => $this->username,
                'timestamp' => now()->toTimeString()
            ];

            // Adiciona localmente
            $this->messages[] = $messageData;

            // Dispara o evento para outros usuários
            broadcast(new MessageSent($this->newMessage, $this->username));

            $this->newMessage = '';
        }
    }
    
    public function render()
    {
        return view('livewire.chat-component');
    }
}
