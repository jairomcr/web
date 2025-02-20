<?php

namespace App\Observers;

use App\Models\Post;

class PostObserver
{
    /**
     * Handle the Post "created" event.
     */
    public function creating(Post $post): void
    {
        if (! \App::runningInConsole()) {
            $post->user_id = auth()->user()->id;
        }
        
    }

    
}
