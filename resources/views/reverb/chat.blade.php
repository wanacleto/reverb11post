<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Laravel + Livewire + Reverb</title>
    <script src="https://cdn.tailwindcss.com"></script>
    
    @livewireStyles
</head>
<body class="bg-gray-100 py-8">
    <div class="container mx-auto">
        <h1 class="text-3xl font-bold text-center mb-8">Chat em Tempo Real</h1>
        <livewire:chat-component />
    </div>
    @livewireScripts
    <script>
        document.addEventListener('livewire:load', () => {
            Livewire.hook('request', ({ request }) => {
                if (window.Echo && window.Echo.socketId) {
                    request.headers['X-Socket-Id'] = window.Echo.socketId();
                }
            });
        });
    </script>
    @vite(['resources/js/app.js'])
</body>
</html>