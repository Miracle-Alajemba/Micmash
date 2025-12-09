<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Micmash - Connect</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="bg-gray-50 antialiased">

        <nav x-data="{ open: false }" class="sticky top-0 z-50 border-b border-gray-100 bg-white font-sans shadow-sm">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex h-16 items-center justify-between">

                    <!-- 1. LEFT: LOGO -->
                    <div class="flex flex-1 justify-start">
                        <a href="{{ route('home') }}" class="group flex items-center gap-2">
                            <div
                                class="rounded-lg bg-indigo-600 p-2 text-white shadow-md transition group-hover:bg-indigo-700">
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

                    <!-- 2. CENTER: NAVIGATION LINKS (Desktop) -->
                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">

                        <!-- HOME -->
                        <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
                            {{ __('Home') }}
                        </x-nav-link>

                        <!-- BROWSE EVENTS (Updated Route) -->
                        <x-nav-link :href="route('events.index')" :active="request()->routeIs('events.index')">
                            {{ __('Browse Events') }}
                        </x-nav-link>

                        <x-nav-link :href="route('about')" :active="request()->routeIs('events.index')">
                            {{ __('About us') }}
                        </x-nav-link>
                        <!-- 3. CREATE EVENT -->
                        @auth
                            <x-nav-link :href="route('events.create')" :active="request()->routeIs('events.create')">
                                {{ __('Create Event') }}
                            </x-nav-link>
                        @endauth

                        <!-- 4. ADMIN -->
                        @if (Auth::check() && Auth::user()->is_admin)
                            <x-nav-link :href="route('admin.events.index')" :active="request()->routeIs('admin.*')">
                                {{ __('Admin Panel') }}
                            </x-nav-link>
                        @endif
                    </div>

                    <!-- 3. RIGHT: ACTIONS (Desktop) -->
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
                                <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden"
                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
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


        <!-- HERO SECTION -->
        <div class="relative overflow-hidden bg-white pb-12 pt-24 lg:pb-24 lg:pt-32">
            <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <h1 class="text-4xl font-extrabold tracking-tight text-gray-900 sm:text-5xl md:text-6xl">
                        <span class="block">Discover local events</span>
                        <span class="block text-indigo-600">Connect with your community</span>
                    </h1>
                    <p class="mx-auto mt-3 max-w-md text-base text-gray-500 sm:text-lg md:mt-5 md:max-w-3xl md:text-xl">
                        Join thousands of people organizing and attending events near you. From tech workshops to music
                        festivals, find your next experience here.
                    </p>
                    <div class="mx-auto mt-5 max-w-md sm:flex sm:justify-center md:mt-8">
                        <div class="rounded-md shadow">
                            <a href="{{ route('events.index') }}"
                                class="flex w-full items-center justify-center rounded-md border border-transparent bg-indigo-600 px-8 py-3 text-base font-medium text-white hover:bg-indigo-700 md:py-4 md:text-lg">
                                Explore Events
                            </a>
                        </div>
                        <div class="mt-3 rounded-md shadow sm:ml-3 sm:mt-0">
                            <a href="{{ route('register') }}"
                                class="flex w-full items-center justify-center rounded-md border border-transparent bg-white px-8 py-3 text-base font-medium text-indigo-600 hover:bg-gray-50 md:py-4 md:text-lg">
                                Get Started
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- FEATURES SECTION -->
        <div class="bg-gray-50 py-12">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="mb-12 lg:text-center">
                    <h2 class="text-base font-semibold uppercase tracking-wide text-indigo-600">Features</h2>
                    <p class="mt-2 text-3xl font-extrabold leading-8 tracking-tight text-gray-900 sm:text-4xl">
                        Everything you need
                    </p>
                </div>

                <div class="mt-10">
                    <div class="grid grid-cols-1 gap-10 sm:grid-cols-2 lg:grid-cols-3">
                        <!-- Feature 1 -->
                        <div class="rounded-xl bg-white p-6 shadow-sm transition hover:shadow-md">
                            <div
                                class="mb-4 flex h-12 w-12 items-center justify-center rounded-md bg-indigo-500 text-white">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-medium leading-6 text-gray-900">Host Events</h3>
                            <p class="mt-2 text-base text-gray-500">
                                Create your own events in minutes. Manage details, locations, and speakers easily.
                            </p>
                        </div>

                        <!-- Feature 2 -->
                        <div class="rounded-xl bg-white p-6 shadow-sm transition hover:shadow-md">
                            <div
                                class="mb-4 flex h-12 w-12 items-center justify-center rounded-md bg-indigo-500 text-white">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-medium leading-6 text-gray-900">Connect</h3>
                            <p class="mt-2 text-base text-gray-500">
                                RSVP to events, see who's going, and join the discussion in the comments.
                            </p>
                        </div>

                        <!-- Feature 3 -->
                        <div class="rounded-xl bg-white p-6 shadow-sm transition hover:shadow-md">
                            <div
                                class="mb-4 flex h-12 w-12 items-center justify-center rounded-md bg-indigo-500 text-white">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-medium leading-6 text-gray-900">Secure & Verified</h3>
                            <p class="mt-2 text-base text-gray-500">
                                We ensure a safe community with email verification and active content moderation.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- FAQ SECTION -->
        <div class="bg-white py-12 lg:py-24">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="mb-12 text-center">
                    <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">
                        Frequently Asked Questions
                    </h2>
                    <p class="mt-4 text-lg text-gray-500">
                        Everything you need to know about Micmash.
                    </p>
                </div>

                <div class="mx-auto max-w-3xl divide-y-2 divide-gray-200">

                    <!-- Question 1 -->
                    <details class="group cursor-pointer py-4">
                        <summary class="flex list-none items-center justify-between font-medium text-gray-900">
                            <span>How do I join an event?</span>
                            <span class="transition group-open:rotate-180">
                                <svg fill="none" height="24" shape-rendering="geometricPrecision"
                                    stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="1.5" viewBox="0 0 24 24" width="24">
                                    <path d="M6 9l6 6 6-6"></path>
                                </svg>
                            </span>
                        </summary>
                        <p class="group-open:animate-fadeIn mt-3 text-gray-500">
                            Simply create an account, browse the events list, and click the "Join Event" button on any
                            event page. It's that easy!
                        </p>
                    </details>

                    <!-- Question 2 -->
                    <details class="group cursor-pointer py-4">
                        <summary class="flex list-none items-center justify-between font-medium text-gray-900">
                            <span>Is it free to organize events?</span>
                            <span class="transition group-open:rotate-180">
                                <svg fill="none" height="24" shape-rendering="geometricPrecision"
                                    stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="1.5" viewBox="0 0 24 24" width="24">
                                    <path d="M6 9l6 6 6-6"></path>
                                </svg>
                            </span>
                        </summary>
                        <p class="group-open:animate-fadeIn mt-3 text-gray-500">
                            Yes! Micmash is a community-driven platform. Any verified user can create and host events
                            for free.
                        </p>
                    </details>

                    <!-- Question 3 -->
                    <details class="group cursor-pointer py-4">
                        <summary class="flex list-none items-center justify-between font-medium text-gray-900">
                            <span>Why do I need to verify my email?</span>
                            <span class="transition group-open:rotate-180">
                                <svg fill="none" height="24" shape-rendering="geometricPrecision"
                                    stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="1.5" viewBox="0 0 24 24" width="24">
                                    <path d="M6 9l6 6 6-6"></path>
                                </svg>
                            </span>
                        </summary>
                        <p class="group-open:animate-fadeIn mt-3 text-gray-500">
                            To keep our community safe and prevent spam bots, we require all users to verify their email
                            address before they can post or join events.
                        </p>
                    </details>

                    <!-- Question 4 -->
                    <details class="group cursor-pointer py-4">
                        <summary class="flex list-none items-center justify-between font-medium text-gray-900">
                            <span>Can I cancel my RSVP?</span>
                            <span class="transition group-open:rotate-180">
                                <svg fill="none" height="24" shape-rendering="geometricPrecision"
                                    stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="1.5" viewBox="0 0 24 24" width="24">
                                    <path d="M6 9l6 6 6-6"></path>
                                </svg>
                            </span>
                        </summary>
                        <p class="group-open:animate-fadeIn mt-3 text-gray-500">
                            Absolutely. If you can no longer attend, simply visit the event page and click "Leave Event"
                            so the organizer knows.
                        </p>
                    </details>

                </div>
            </div>
        </div>
        <!-- FOOTER -->
        <!-- ✨ This is where the footer started ✨ -->
        <footer class="mt-12 bg-indigo-900 text-gray-100">
            <div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">

                <!-- Grid Layout -->
                <div class="grid grid-cols-1 gap-8 md:grid-cols-4">

                    <!-- Column 1: Brand -->
                    <div class="space-y-4">
                        <h3 class="text-2xl font-bold text-white">Micmash</h3>
                        <p class="text-sm leading-relaxed text-gray-100">
                            The best platform to discover local events,Join workshops, conferences, and meetups
                            happening around you.
                        </p>
                        <!-- Social Icons -->
                        <div class="flex space-x-4 pt-2">
                            <a href="#" class="text-gray-100 transition hover:text-white">
                                <span class="sr-only">Facebook</span>
                                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                        d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"
                                        clip-rule="evenodd" />
                                </svg>
                            </a>
                            <a href="#" class="text-gray-100 transition hover:text-white">
                                <span class="sr-only">Twitter</span>
                                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
                                </svg>
                            </a>
                            <a href="#" class="text-gray-100 transition hover:text-white">
                                <span class="sr-only">Instagram</span>
                                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                        d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772 4.902 4.902 0 011.772-1.153c.636-.247 1.363-.416 2.427-.465C9.673 2.013 10.03 2 12.488 2h.172zM12 7a5 5 0 100 10 5 5 0 000-10zm0 8a3 3 0 110-6 3 3 0 010 6zm5.338-3.205a1.2 1.2 0 110-2.4 1.2 1.2 0 010 2.4z"
                                        clip-rule="evenodd" />
                                </svg>
                            </a>
                        </div>
                    </div>

                    <!-- Column 2: Quick Links -->
                    <div>
                        <h3 class="mb-4 text-sm font-bold uppercase tracking-wider text-white">Quick Links</h3>
                        <ul class="space-y-2">
                            <li><a href="{{ route('events.index') }}" class="transition hover:text-indigo-400">Browse
                                    Events</a></li>
                            <li><a href="{{ route('about') }}" class="transition hover:text-indigo-400">About Us</a>
                            </li>
                            <li><a href="#" class="transition hover:text-indigo-400">Contact Support</a></li>
                            <li><a href="#" class="transition hover:text-indigo-400">Terms of Service</a></li>
                        </ul>
                    </div>

                    <!-- Column 3: Categories -->
                    <div>
                        <h3 class="mb-4 text-sm font-bold uppercase tracking-wider text-white">Popular Categories
                        </h3>
                        <ul class="space-y-2">
                            <li><a href="{{ route('events.index', ['category' => 1]) }}"
                                    class="transition hover:text-indigo-400">Technology</a></li>
                            <li><a href="{{ route('events.index', ['category' => 2]) }}"
                                    class="transition hover:text-indigo-400">Music</a></li>
                            <li><a href="{{ route('events.index', ['category' => 3]) }}"
                                    class="transition hover:text-indigo-400">Sports</a></li>
                            <li><a href="{{ route('events.index', ['category' => 4]) }}"
                                    class="transition hover:text-indigo-400">Workshops</a></li>
                        </ul>
                    </div>

                    <!-- Column 4: Newsletter -->
                    <div>
                        <h3 class="mb-4 text-sm font-bold uppercase tracking-wider text-white">Stay Updated</h3>
                        <p class="mb-4 text-sm text-gray-100">Subscribe to our newsletter for the latest events.</p>
                        <form action="#" class="flex flex-col space-y-2">
                            <input type="email" placeholder="Enter your email"
                                class="border-gray-00 rounded border bg-gray-800 px-3 py-2 text-sm text-white focus:border-indigo-500 focus:outline-none">
                            <button type="button"
                                class="rounded bg-indigo-600 px-4 py-2 text-sm font-bold text-white transition hover:bg-indigo-700">
                                Subscribe
                            </button>
                        </form>
                    </div>

                </div>

                <!-- Bottom Bar -->
                <div
                    class="mt-12 flex flex-col items-center justify-between border-t border-gray-500 pt-8 md:flex-row">
                    <p class="text-sm text-gray-100">
                        &copy; {{ date('Y') }} Micmash. All rights reserved.
                    </p>
                    <p class="text-white-600 mt-2 text-sm md:mt-0">
                        Designed with ❤️ in Laravel
                    </p>
                </div>

            </div>
        </footer>

    </body>

</html>
