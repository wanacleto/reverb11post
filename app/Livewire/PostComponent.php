<?php
namespace App\Livewire;

use App\Events\PostCreate;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Mail\SendWelcomeEmail;
use App\Jobs\JobSendWelcomeEmail;
use Illuminate\Support\Facades\Mail;


class PostComponent extends Component
{
    public $title = '';
    public $name = '';
    public $email = '';
    public $body = '';

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
            'title' => $this->title,
            'name' => $this->name,
            'email' => $this->email,
            'body' => $this->body
        ]);

        // Disparar evento para notificação em tempo real
        // event(new PostCreate($post));
        // Mail::to($post->email)->send(new SendWelcomeEmail($post) );
        JobSendWelcomeEmail::dispatch($post->id)->onQueue('default');
        

        // Limpar campo e mostrar mensagem
        $this->title = '';
        $this->name = '';
        $this->email = '';
        $this->body = '';
        $this->dispatch('alert', type: 'error', message: 'Post criado com sucesso!');

    }
}
