@props(['post'])
<article {{ $attributes->merge(['class' => '[&:not(:last-child)]:border-b border-gray-100 pb-10']) }}>
    <div class="grid items-start grid-cols-12 gap-3 mt-5 article-body">
        <div class="flex items-center col-span-4 article-thumbnail">
            <a wire:navigate href="{{ route('posts.show', $post->slug) }}">
                <img class="mx-auto mw-100 rounded-xl" src="{{ $post->getThumbnailImage() }}" alt="thumbnail">
            </a>
        </div>
        <div class="col-span-8">
            <div class="flex items-center py-1 text-sm article-meta">
                <x-posts.author-badge :author="$post->author" size="sm" />
                <span class="text-xs text-gray-500">. {{ $post->published_at->diffForHumans() }}</span>
            </div>
            <h2 class="text-xl font-bold text-gray-900">
                <a wire:navigate href="{{ route('posts.show', $post->slug) }}">
                    {{ $post->title }}
                </a>
            </h2>

            <p class="mt-2 text-base font-light text-gray-700">
                {{ $post->getExcerpt() }}
            </p>
            <div class="flex items-center justify-between mt-6 article-actions-bar">
                <div>
                    @foreach ($post->categories as $category)
                        <x-badge wire:navigate href="{{ route('posts.index', ['category' => $category->title]) }}"
                            textColor="{{ $category->text_color }}" bgColor="{{ $category->bg_color }}">
                            {{ $category->title }}
                        </x-badge>
                    @endforeach
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-sm text-gray-500">{{ $post->getReadingTime() }} minutes read.</span>
                </div>
                <div>
                    <livewire:like-button :key="'like-' . $post->id" :$post />
                </div>
            </div>
        </div>
    </div>
</article>
