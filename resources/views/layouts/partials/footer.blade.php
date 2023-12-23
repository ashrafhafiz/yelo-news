<footer class="flex flex-wrap items-center justify-between px-4 py-4 space-x-4 text-sm border-t border-gray-100 ">
    <div class="flex space-x-4">
        {{-- <a href="{{ route('locale', 'en') }}"><x-flag-country-us class="w-6 h-6" /></a>
        <a href="{{ route('locale', 'fr') }}"><x-flag-country-fr class="w-6 h-6" /></a> --}}
        {{-- When applying supported loacles array in app config to make it dynamic --}}
        @foreach (config('app.supported_locales') as $locale => $data)
            <a href="{{ route('locale', $locale) }}">
                <x-dynamic-component :component="'flag-country-' . $data['icon']" class="w-6 h-6" />
            </a>
        @endforeach
    </div>
    <div class="flex space-x-4">
        <a class="text-gray-500 hover:text-yellow-500" href="">About Us</a>
        <a class="text-gray-500 hover:text-yellow-500" href="">Help</a>
        <a class="text-gray-500 hover:text-yellow-500" href="">Login</a>
        <a class="text-gray-500 hover:text-yellow-500" href="">Explore</a>
    </div>
</footer>
