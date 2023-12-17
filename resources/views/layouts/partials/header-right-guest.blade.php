<div class="flex space-x-5">
    <x-nav-link href="{{ route('login') }}" :active="request()->routeIs('login')">
        {{ __('Login') }}
    </x-nav-link>
    <x-nav-link href="{{ route('register') }}" :active="request()->routeIs('register')">
        {{ __('Register') }}
    </x-nav-link>
    {{-- <a class="flex space-x-2 items-center hover:text-yellow-500 text-sm text-gray-500"
        href="{{ env('APP_URL') }}/login">
        Login
    </a>
    <a class="flex space-x-2 items-center hover:text-yellow-500 text-sm text-gray-500"
        href="{{ env('APP_URL') }}/register">
        Register
    </a> --}}
</div>
