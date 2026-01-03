<nav x-data="{ open: false }" class="sticky top-0 z-50 border-b border-gray-100 bg-white font-sans shadow-sm">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">

            <!--  LEFT: LOGO -->
            <div class="flex flex-1 justify-start">
                <a href="{{ route('home') }}" class="group flex items-center gap-2">
                    <div class="rounded-lg bg-indigo-600 p-2 text-white shadow-md transition group-hover:bg-indigo-700">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                            </path>
                        </svg>
                    </div>
                    <span
                        class="text-xl font-bold tracking-tight text-gray-800 transition group-hover:text-indigo-700">Micmash</span>
                </a>
            </div>

            <!--  CENTER: NAVIGATION LINKS (Desktop) -->
            <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">

                <!--  HOME -->
                <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
                    {{ __('Home') }}
                </x-nav-link>
                <!-- BROWSE EVENTS -->
                <x-nav-link :href="route('events.index')" :active="request()->routeIs('events.index')">
                    {{ __('Browse Events') }}
                </x-nav-link>
                <x-nav-link :href="route('about')" :active="request()->routeIs('home')">
                    {{ __('About us') }}
                </x-nav-link>
                @auth
                    <x-nav-link :href="route('tickets.index')" :active="request()->routeIs('tickets.index')">
                        {{ __('My Tickets') }}
                </x-nav-link> @endauth
                <!-- 4. ADMIN -->
                @if (Auth::check() && Auth::user()->is_admin)
                    <x-nav-link :href="route('admin.events.index')" :active="request()->routeIs('admin.*')">
                        {{ __('Admin Panel') }}
                    </x-nav-link>
                @endif
            </div>

            <!--  RIGHT: ACTIONS (Desktop) -->
            <div class="hidden flex-1 items-center justify-end space-x-4 sm:flex">
                @auth
                    <!-- "Create Event" Button -->
                    <a href="{{ route('events.create') }}"
                        class="hidden transform items-center gap-2 rounded-full border border-indigo-200 bg-indigo-50 px-4 py-2 text-sm font-bold text-indigo-700 transition hover:scale-105 hover:bg-indigo-100 md:flex">
                        <span>+ Create</span>
                    </a>

                    <!-- Profile Dropdown -->
                    <div class="relative ms-3">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button
                                    class="inline-flex items-center gap-2 rounded-full border border-gray-200 bg-white py-1.5 pl-3 pr-2 text-sm font-medium text-gray-700 shadow-sm transition hover:bg-gray-50 focus:outline-none">
                                    <span>{{ Auth::user()->name }}</span>
                                    <div
                                        class="flex h-8 w-8 items-center justify-center rounded-full bg-indigo-600 text-xs font-bold text-white">
                                        {{ substr(Auth::user()->name, 0, 1) }}
                                    </div>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link :href="route('profile.edit')">
                                    {{ __('Profile') }}
                                </x-dropdown-link>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>
                @else
                    <!-- GUEST: Login & Signup Buttons -->
                    <div class="flex items-center gap-3">
                        <!-- Login Button (Medium Blue) -->
                        <a href="{{ route('login') }}"
                            class="transform rounded-full bg-indigo-700 px-6 py-2 text-sm font-bold text-white shadow-md transition hover:-translate-y-0.5 hover:bg-indigo-800">
                            Log in
                        </a>

                        <!-- Sign Up Button (Dark Blue) -->
                        <a href="{{ route('register') }}"
                            class="transform rounded-full bg-indigo-700 px-6 py-2 text-sm font-bold text-white shadow-md transition hover:-translate-y-0.5 hover:bg-indigo-800">
                            Sign up
                        </a>
                    </div>
                @endauth
            </div>

            <!-- HAMBURGER (Mobile) -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center rounded-md p-2 text-gray-400 transition hover:bg-gray-100 hover:text-gray-500 focus:outline-none">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- ======================= -->
    <!-- MOBILE MENU (Responsive) -->
    <!-- ======================= -->
    <div :class="{ 'block': open, 'hidden': !open }"
        class="hidden border-t border-gray-100 bg-white shadow-inner sm:hidden">

        <!-- Mobile Links -->
        <div class="space-y-1 pb-3 pt-2">
            <x-responsive-nav-link :href="route('events.index')" :active="request()->routeIs('events.index')">
                {{ __('Discover') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('about')" :active="request()->routeIs('about')">
                {{ __('About Us') }}
            </x-responsive-nav-link>

            @auth
                <x-responsive-nav-link :href="route('events.create')" :active="request()->routeIs('events.create')" class="font-bold text-indigo-600">
                    {{ __('+ Create New Event') }}
                </x-responsive-nav-link>

                @if (Auth::user()->is_admin)
                    <x-responsive-nav-link :href="route('admin.events.index')" :active="request()->routeIs('admin.*')">
                        {{ __('Admin Panel') }}
                    </x-responsive-nav-link>
                @endif
            @endauth
        </div>

        <!-- Mobile Auth/Profile Options -->
        <div class="border-t border-gray-200 pb-1 pt-4">
            @auth
                <!-- LOGGED IN: Profile Info -->
                <div class="flex items-center gap-3 px-4">
                    <div
                        class="flex h-10 w-10 items-center justify-center rounded-full bg-indigo-100 text-lg font-bold text-indigo-700">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <div>
                        <div class="text-base font-bold text-gray-800">{{ Auth::user()->name }}</div>
                        <div class="text-sm font-medium text-gray-500">{{ Auth::user()->email }}</div>
                    </div>
                </div>

                <div class="mt-4 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Profile Settings') }}
                    </x-responsive-nav-link>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault(); this.closest('form').submit();" class="text-red-600">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            @else
                <!-- GUEST: Big Blue Buttons -->
                <div class="mt-3 space-y-3 px-4 pb-6">
                    <!-- Mobile Login -->
                    <a href="{{ route('login') }}"
                        class="block w-full rounded-full bg-indigo-500 py-3 text-center font-bold text-white shadow-sm hover:bg-indigo-600">
                        Log in
                    </a>
                    <!-- Mobile Signup -->
                    <a href="{{ route('register') }}"
                        class="block w-full rounded-full bg-indigo-700 py-3 text-center font-bold text-white shadow-md hover:bg-indigo-800">
                        Sign Up
                    </a>
                </div>
            @endauth
        </div>
    </div>
</nav>
