<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Laravel + Livewire + Reverb</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
    @livewireStyles
</head>
<body class="bg-gray-100 py-8">
    <div class="container mx-auto">
        <h1 class="text-3xl font-bold text-center mb-8">Chat em Tempo Real</h1>
        <livewire:post-component />
    </div>

    @livewireScripts
    @vite(['resources/js/app.js'])

    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('alert', ({ type, message }) => {
                Swal.fire({
                    icon: type,
                    title: message,
                    showConfirmButton: false,
                    timer: 2000
                });
            });
        });
    </script>
</body>
</html>