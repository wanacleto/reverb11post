<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PostController;
use App\Events\NovaMensagem;
use App\Livewire\ChatComponent;


Route::get('/', function () {
    return view('reverb.chat');
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');

Route::get('/reverb', function () {
    return view('reverb.index');
});

Route::get('/enviar', function () {
    broadcast(new NovaMensagem('Olá mundo via Reverb!'));
    return 'Mensagem enviada!';
});


// Route::get('/chatt', ChatComponent::class)->name('chat');

Route::get('/post', function () {
    return view('post');
});

Route::get('/postss', function () {
    return view('postss');
});

Route::get('/chat', function () {
    return view('reverb.chat');
});

Route::get('/lotomania', function () {
    return view('lotomania.index');
});
