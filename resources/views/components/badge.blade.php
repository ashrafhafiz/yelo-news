@props(['textColor', 'bgColor'])
@php
    $textColor = match ($textColor) {
        'gray' => 'text-gray-100',
        'blue' => 'text-blue-100',
        'yellow' => 'text-yellow-100',
        'red' => 'text-red-100',
        default => 'text-gray-100'
    };

    $bgColor = match ($bgColor) {
        'gray' => 'bg-gray-800',
        'blue' => 'bg-blue-800',
        'yellow' => 'bg-yellow-800',
        'red' => 'bg-red-800',
        default => 'bg-gray-800'
    };
@endphp
<button {{ $attributes }} class="px-3 py-1 text-base rounded-xl {{ $textColor }} {{ $bgColor }}">
    {{ $slot }}
</button>
