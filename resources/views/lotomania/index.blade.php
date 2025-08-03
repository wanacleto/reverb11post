
<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <title>Lotomania</title>

    <!-- Bootstrap 5.3 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    @livewireStyles
</head>
<body>

    <div class="container py-5">
        <h2 class="mb-4">💬 Chat ao Vivo</h2>

        <!-- Carregando o componente Livewire -->
        <livewire:lotomania.lotomania-component />

    </div>

    <!-- Scripts Bootstrap e Livewire -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @livewireScripts
</body>
</html>
