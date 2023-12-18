<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Post;
use Livewire\Component;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\WithPagination;

class PostList extends Component
{
    use WithPagination;

    #[Url()]
    public $sortDir = 'desc';
    #[Url()]
    public $search = '';
    #[Url()]
    public $category = '';

    #[On('search')]
    public function updateSearch($search)
    {
        $this->search = $search;
    }

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
        return Post::published()
            ->when(Category::where('slug', $this->category)->first(), function ($query) {
                $query->withCategory($this->category);
            })
            ->where('title', 'like', "%{$this->search}%")
            ->orderBy('published_at', $this->sortDir)
            ->paginate(3);
    }

    public function render()
    {
        return view('livewire.post-list');
    }
}
