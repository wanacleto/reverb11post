<div 
    class="max-w-md mx-auto bg-white rounded-xl shadow-md overflow-hidden"
    {{-- wire:poll.keep-alive --}}
>
    <div class="p-6">
        <h2 class="text-xl font-bold mb-4">Chat em Tempo Real</h2>

        <div class="mb-4 p-2 bg-gray-100 rounded">
            <strong>Seu nome:</strong> {{ $username }}
        </div>

        <!-- Área de mensagens -->
        <div 
            id="messages" 
            class="h-64 overflow-y-auto border rounded p-3 mb-4 bg-gray-50"
        >
            @foreach($messages as $message)
                <div class="mb-2 p-2 bg-white rounded shadow-sm">
                    <strong>{{ $message['user'] }}:</strong>
                    <span>{{ $message['text'] }}</span>
                    <small class="text-gray-500 block">{{ $message['timestamp'] }}</small>
                </div>
            @endforeach
        </div>

        <!-- Formulário de nova mensagem -->
        <form wire:submit="sendMessage" class="flex gap-2">
            <input 
                type="text" 
                wire:model="newMessage" 
                placeholder="Digite sua mensagem..."
                class="flex-1 px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
            <button 
                type="submit"
                class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
                Enviar
            </button>
        </form>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function () {
            console.log('Inicializando Echo...');

            window.Echo.channel('chat')
                .listen('.create2', (e) => {
                    console.log('Mensagem recebida via broadcast:', e);
    

                    Livewire.dispatch('novaMensagemRecebida', { params: {
                        text: e.message,
                        user: e.user,
                        timestamp: e.timestamp
                    }});

                    // Scroll automático para a última mensagem
                    const messagesDiv = document.getElementById('messages');
                    if (messagesDiv) {
                        messagesDiv.scrollTop = messagesDiv.scrollHeight;
                    }
                })
                .subscribed(() => {
                    console.log('Conectado ao canal chat!');
                })
                .error((error) => {
                    console.error('Erro na conexão:', error);
                });
        });
    </script>

</div>
