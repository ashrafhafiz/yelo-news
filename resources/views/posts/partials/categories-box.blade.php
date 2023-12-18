<div id="recommended-topics-box">
    <h3 class="mb-3 text-lg font-semibold text-gray-900">Recommended Topics</h3>
    <div class="flex flex-wrap justify-start gap-2 topics">
        @foreach ($categories as $category)
            <x-badge>
                {{ $category->title }}
            </x-badge>
        @endforeach
    </div>
</div>
