<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Events\PostCreate;
use App\Mail\SendWelcomeEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;


class PostController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index(Request $request)
    {
        $posts = Post::get();

        return view('posts', compact('posts'));
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function store(Request $request)
    {
        $this->validate($request, [
             'title' => 'required',
             'body' => 'required'
        ]);
   
        $post = Post::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'name' => $request->name,
            'email' => $request->email,
            'body' => $request->body
        ]);

        Mail::to($post->email)->send(new SendWelcomeEmail($post) );

        dd($post);
        // event(new PostCreate($post));
   
        return back()->with('success','Post created successfully.');
    }
}
