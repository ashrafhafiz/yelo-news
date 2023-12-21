<?php

namespace App\Livewire;

use App\Models\Comment;
use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Rule;

class PostComments extends Component
{
    use WithPagination;

    public Post $post;

    #[Rule('required|min:3|max:255')]
    public string $commentBody;

    public function saveCommentBody()
    {
        if (auth()->guest()) {
            return;
        }

        $this->validateOnly('commentBody');
        Comment::create([
            'user_id' => auth()->id(),
            'post_id' => $this->post->id,
            'body' => $this->commentBody
        ]);
        $this->reset('commentBody');
    }

    #[Computed()]
    public function comments()
    {
        return $this?->post?->comments()->latest()->paginate(5);
    }

    #[Computed()]
    public function commentsCount()
    {
        return $this?->post?->comments()->count();
    }

    public function render()
    {
        return view('livewire.post-comments');
    }
}
