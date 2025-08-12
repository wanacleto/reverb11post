<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use App\Models\Post;
use App\Mail\SendWelcomeEmail;
use Illuminate\Support\Facades\Mail;

class JobSendWelcomeEmail implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(private $postId)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $post = Post::find($this->postId);
        // Mail::to($post->email)->send(new SendWelcomeEmail($post) );
        Mail::to($post->email)->later(now()->addMinutes(1), new SendWelcomeEmail($post));
    }
}
