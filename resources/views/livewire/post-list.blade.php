<div id="posts" class="px-3 py-6 lg:px-7">
    <div class="flex items-center justify-between border-b border-gray-100">
        <div class="text-lg text-gray-600">
            @if($this->activeCategory  || $search)
            <button class="mr-3 px-1.5 text-sm text-red-800 border-2 border-red-600 rounded-full" wire:click="clearFilters()">X</button>
            @endif
            @if($this->activeCategory)
                All Posts From:
                <x-badge wire:navigate href="{{ route('posts.index', ['category' => $this->activeCategory->slug]) }}" textColor="{{ $this->activeCategory->text_color }}" bgColor="{{ $this->activeCategory->bg_color }}">
                    {{ $this->activeCategory->title }}
                </x-badge>
            @endif
            @if ($search)
                With Search Results For: <span class="font-semibold">{{ $search }}</span>
            @endif
        </div>
        <div id="filter-selector" class="flex items-center space-x-4 font-light ">
            <button class="{{ $sortDir === 'desc' ? 'text-gray-900 border-b border-gray-700' : 'text-gray-500' }} py-4"
                wire:click="setSortDir('desc')">Latest</button>
            <button class="{{ $sortDir === 'asc' ? 'text-gray-900 border-b border-gray-700' : 'text-gray-500' }} py-4"
                wire:click="setSortDir('asc')">Oldest</button>
        </div>
    </div>
    <div class="py-4">
        @foreach ($this->posts as $post)
            <x-posts.post-item :post="$post" />
        @endforeach
    </div>
    <div class="my-3">
        {{ $this->posts->onEachSide(1)->links() }}
    </div>
</div>
