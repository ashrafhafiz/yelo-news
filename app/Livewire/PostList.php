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
    #[Url()]
    public $popular = false;

    #[On('search')]
    public function updateSearch($search)
    {
        $this->search = $search;
        $this->resetPage();
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
            ->when($this->activeCategory, function ($query) {
                $query->withCategory($this->category);
            })
            ->when($this->popular, function ($query) {
                $query->popular();
            })
            ->where('title', 'like', "%{$this->search}%")
            ->orderBy('published_at', $this->sortDir)
            ->paginate(3);
    }

    #[Computed()]
    public function activeCategory()
    {
        return Category::where('slug', $this->category)->first();
    }

    public function clearFilters()
    {
        $this->search = '';
        $this->category = '';
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.post-list');
    }
}
