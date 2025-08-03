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
        <livewire:post-component />
    </div>
    @section('script')
        @if(auth()->user()->is_admin)
            <script type="module">
                    window.Echo.channel('posts')
                        .listen('.create', (data) => {
                            console.log('Order status updated: ', data);
                            var d1 = document.getElementById('notification');
                            d1.insertAdjacentHTML('beforeend', '<div class="alert alert-success alert-dismissible fade show"><span><i class="fa fa-circle-check"></i>  '+data.message+'</span></div>');
                        });
            </script>
        @endif
    @endsection
    @livewireScripts
    @vite(['resources/js/app.js'])
</body>
</html>