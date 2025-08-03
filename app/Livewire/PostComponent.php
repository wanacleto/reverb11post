<?php
namespace App\Livewire;

use App\Events\PostCreate;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PostComponent extends Component
{
    public $title = '';

    public function render()
    {
        $posts = Post::with('user')->latest()->get();
        return view('livewire.post-component', compact('posts'));
    }

    public function store()
    {
        $this->validate([
            'title' => 'required|min:3|max:255'
        ]);

        $post = Post::create([
            'user_id' => Auth::id(),
            'title' => $this->title
        ]);

        // Disparar evento para notificação em tempo real
        event(new PostCreate($post));
        

        // Limpar campo e mostrar mensagem
        $this->title = '';
        session()->flash('message', 'Post criado com sucesso!');
    }
}
