<div class="p-4">
    {{-- @role('admin') --}}
        <div class="bg-blue-100 p-4 mb-4 rounded">
            <strong>Admin</strong> - Você receberá notificações em tempo real quando novos posts forem criados
        </div>
    {{-- @endrole --}}

    {{-- @role('comum') --}}
        <div class="bg-gray-100 p-4 mb-4 rounded">
            <strong>Criar Novo Post</strong>
        </div>
        <p><strong>Create New Post</strong></p>
        <form wire:submit.prevent="store">
            @csrf
            <div class="form-group">
                <label>Title:</label>
                <input wire:model="title" type="text" name="title" class="form-control" />
                @error('title')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label>Body:</label>
                <textarea wire:model="body" class="form-control" name="body"></textarea>
                @error('body')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group mt-2">
                <button type="submit" class="btn btn-success btn-block"><i class="fa fa-save"></i> Submit</button>
            </div>
        </form>

    {{-- @endrole --}}

    <div class="bg-white shadow rounded">
        <div class="p-4 border-b">
            <h3 class="text-lg font-medium">Posts Recentes</h3>
        </div>
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="border px-4 py-2 text-left">#</th>
                    <th class="border px-4 py-2 text-left">Título</th>
                    <th class="border px-4 py-2 text-left">Usuário</th>
                    <th class="border px-4 py-2 text-left">Data</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                <tr class="border-t">
                    <td class="border px-4 py-2">{{ $post->id }}</td>
                    <td class="border px-4 py-2">{{ $post->title }}</td>
                    <td class="border px-4 py-2">{{ $post->user->name ?? 'N/A' }}</td>
                    <td class="border px-4 py-2">{{ $post->created_at->format('d/m/Y H:i') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
