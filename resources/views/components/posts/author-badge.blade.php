@props(['author', 'size'])

@php
    $imageSize = match ($size ?? null) {
        'xs' => 'w-5 h-5',
        'sm' => 'w-7 h-7',
        'md' => 'w-10 h10',
        'lg' => 'w-12 h-12',
        default => 'w-7 h-7',
    };

    $textSize = match ($size ?? null) {
        'xs' => 'text-xs',
        'sm' => 'text-sm',
        'md' => 'text-md',
        'lg' => 'text-lg',
        default => 'text-base',
    };
@endphp

<img class="mr-3 rounded-full {{ $imageSize }}" src="{{ $author->profile_photo_url }}" alt="avatar">
<span class="mr-1 {{ $textSize }}">{{ $author->name }}</span>
