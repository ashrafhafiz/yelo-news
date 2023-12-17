<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;
use Livewire\WithPagination;

class PostList extends Component
{
    use WithPagination;

    #[Url()]
    public $sortDir = 'desc';

    public function setSortDir($sortDir)
    {
        $this->sortDir =  $sortDir === 'desc' ? 'desc' : 'asc';
        $this->resetPage();
    }
    // Public properity does not support pagination (dynamic values)
    // Computeed properities
    #[Computed()]
    public function posts()
    {
        return Post::published()->orderBy('published_at', $this->sortDir)->paginate(3);
    }

    public function render()
    {
        return view('livewire.post-list');
    }
}
