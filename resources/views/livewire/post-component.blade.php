<div class="p-4">
    
        <div class="bg-blue-100 p-4 mb-4 rounded">
            <strong>Admin</strong> - Você receberá notificações em tempo real quando novos posts forem criados
        </div>
        <div class="space-y-4 mb-3">
            <form wire:submit.prevent="store" class="space-y-4 bg-white p-6 rounded shadow">
                <input type="text" wire:model.defer="title" placeholder="Título" class="w-full p-2 border border-gray-300 rounded">
                @error('title')<div class="text-danger">{{ $message }}</div>@enderror
                <input type="text" wire:model.defer="name" placeholder="Seu nome" class="w-full p-2 border border-gray-300 rounded">
                @error('name')<div class="text-danger">{{ $message }}</div>@enderror
                <input type="email" wire:model.defer="email" placeholder="Seu email" class="w-full p-2 border border-gray-300 rounded">
                @error('email')<div class="text-danger">{{ $message }}</div>@enderror
                <textarea wire:model.defer="body" placeholder="Mensagem" class="w-full p-2 border border-gray-300 rounded"></textarea>
                @error('body')<div class="text-danger">{{ $message }}</div>@enderror
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Enviar</button>
            </form>
        </div>
        {{-- <x-sweetalert-session /> --}}
        {{-- @include('components.sweetalert-session') --}}


    <div class="bg-white shadow rounded mb-3">
        <div class="p-4 border-b">
            <h3 class="text-lg font-medium">Posts Recentes</h3>
        </div>
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="border px-4 py-2 text-left">#</th>
                    <th class="border px-4 py-2 text-left">Título</th>
                    <th class="border px-4 py-2 text-left">Name</th>
                    <th class="border px-4 py-2 text-left">Email</th>
                    <th class="border px-4 py-2 text-left">Usuário</th>
                    <th class="border px-4 py-2 text-left">Data</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                <tr class="border-t">
                    <td class="border px-4 py-2">{{ $post->id }}</td>
                    <td class="border px-4 py-2">{{ $post->title }}</td>
                    <td class="border px-4 py-2">{{ $post->name }}</td>
                    <td class="border px-4 py-2">{{ $post->email }}</td>
                    <td class="border px-4 py-2">{{ $post->user->name ?? 'N/A' }}</td>
                    <td class="border px-4 py-2">{{ $post->created_at->format('d/m/Y H:i') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>


    <div class="space-y-4">
   
        <div class="bg-white rounded shadow p-4 space-y-2">
            @foreach($posts as $post)
                <div class="border-b border-gray-200 pb-2">
                    <h2 class="font-bold">{{ $post->title }}</h2>
                    <p class="text-gray-600">{{ $post->body }}</p>
                    <small class="text-sm text-gray-400">por {{ $post->name }}</small>
                </div>
            @endforeach
        </div>
    </div>

    
</div>
