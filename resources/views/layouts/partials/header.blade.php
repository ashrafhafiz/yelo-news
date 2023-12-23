<header class="flex items-center justify-between px-6 py-3 border-b border-gray-100">
    <div id="header-left" class="flex items-center">
        <div class="font-semibold text-gray-800">
            <span class="text-xl text-yellow-500">&lt;YELO&gt;</span> Code
        </div>
        <div class="ml-10 top-menu">
            <div class="flex space-x-4">
                <x-nav-link href="{{ route('home') }}" :active="request()->routeIs('home')">
                    {{ __('homepage.home') }}
                </x-nav-link>
                <x-nav-link href="{{ route('posts.index') }}" :active="request()->routeIs('posts.index')">
                    {{ __('homepage.blog') }}
                </x-nav-link>
                {{--

                <x-nav-link href="{{ route('home') }}" :active="request()->routeIs('home')">
                    {{ __('About Us') }}
                </x-nav-link>

                <x-nav-link href="{{ route('home') }}" :active="request()->routeIs('home')">
                    {{ __('Contact Us') }}
                </x-nav-link>

                <x-nav-link href="{{ route('home') }}" :active="request()->routeIs('home')">
                    {{ __('Terms') }}
                </x-nav-link> --}}

            </div>
        </div>
    </div>
    <div id="header-right" class="flex items-center md:space-x-6">
        @guest
            @include('layouts.partials.header-right-guest')
        @endguest

        <!-- Settings Dropdown -->
        @auth
            @include('layouts.partials.header-right-auth')
        @endauth
    </div>
</header>
