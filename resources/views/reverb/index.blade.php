<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Contador com Livewire e Reverb</title>
    
    @livewireStyles

    <!-- Laravel Echo e Reverb via Vite (JS moderno) -->
    <script type="module">
        import Echo from 'laravel-echo';

        window.Echo = new Echo({
            broadcaster: 'reverb',
            key: import.meta.env.VITE_REVERB_APP_KEY,
            host: `${import.meta.env.VITE_REVERB_HOST}:${import.meta.env.VITE_REVERB_PORT}`,
            wsHost: import.meta.env.VITE_REVERB_HOST,
            wsPort: import.meta.env.VITE_REVERB_PORT,
            disableStats: true,
            forceTLS: false,
            enabledTransports: ['ws', 'wss'],
        });

        // Logs para debug de conexão
        console.log('Echo conectado?', window.Echo.connector?.socket?.connected);

        window.Echo.connector?.socket?.on('connect', () => {
            console.log('WebSocket conectado');
        });

        window.Echo.connector?.socket?.on('disconnect', () => {
            console.log('WebSocket desconectado');
        });
    </script>
</head>
<body>
    @livewire('contador')

    @livewireScripts
</body>
</html>
