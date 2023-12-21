<div class="pt-10 mt-10 border-t border-gray-100 comments-box">
    <h2 class="mb-5 text-2xl font-semibold text-gray-900">Discussions ({{ $this->commentsCount() }})</h2>
    @auth
        <textarea wire:model='commentBody'
            class="w-full p-4 text-sm text-gray-700 border-gray-200 rounded-lg bg-gray-50 focus:outline-none placeholder:text-gray-400"
            cols="30" rows="7"></textarea>
        <button wire:click='saveCommentBody'
            class="inline-flex items-center justify-center h-10 px-4 mt-3 font-medium tracking-wide text-white transition duration-200 bg-gray-900 rounded-lg hover:bg-gray-800 focus:shadow-outline focus:outline-none">
            Post Comment
        </button>
    @else
        <div class="flex flex-col w-full">
            <div class="relative p-6 bg-gray-50 border shadow hover:border-yellow-500 rounded-xl">
                <div class="flex">
                    <p class="font-bold leading-none text-gray-800">
                        Please <a href="{{ route('login') }}" class="text-yellow-500 unerline">login</a>, or <a
                            href="{{ route('register') }}" class="text-yellow-500 unerline">signup</a> to write a comment.
                    </p>
                </div>
            </div>
        </div>
    @endauth


    <div class="px-3 py-2 mt-5 user-comments">
        @forelse ($this->comments as $comment)
            <div class="comment [&:not(:last-child)]:border-b border-gray-100 py-5">
                <div class="flex items-center mb-4 text-sm user-meta">
                    <x-posts.author-badge :author="$comment->author" size="sm" />
                    <span class="text-gray-500">. {{ $comment->created_at->diffFOrHumans() }}</span>
                </div>
                <div class="text-sm text-justify text-gray-700">
                    {{ $comment->body }}
                </div>
            </div>
        @empty
            <div class="text-center text-gray-500">
                <span> No Comments Posted</span>
            </div>
        @endforelse
    </div>
    <div class="my-2">{{ $this->comments->links() }}</div>

</div>
