<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Micmash - Discover Local Events</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
            rel="stylesheet">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            body {
                font-family: 'Plus Jakarta Sans', sans-serif;
            }
        </style>
    </head>

    <body class="bg-white text-gray-900 antialiased selection:bg-indigo-500 selection:text-white">

        <!-- NAVIGATION -->
        <nav x-data="{ open: false }"
            class="fixed top-0 z-50 w-full border-b border-gray-100 bg-white/80 backdrop-blur-md transition-all duration-300">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex h-20 items-center justify-between">

                    <!-- LOGO -->
                    <div class="flex flex-shrink-0 items-center gap-2">
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
                                class="text-xl font-bold tracking-tight text-gray-700 transition group-hover:text-indigo-700">Micmash</span>
                        </a>
                    </div>
                    <!-- DESKTOP MENU -->
                    <div class="hidden items-center space-x-8 md:flex">
                        <a href="{{ route('events.index') }}"
                            class="text-sm font-semibold text-gray-600 transition hover:text-indigo-600">Discover</a>
                        <a href="{{ route('about') }}"
                            class="text-sm font-semibold text-gray-600 transition hover:text-indigo-600">About</a>
                        @auth
                            @if (Auth::user()->is_admin)
                                <a href="{{ route('admin.events.index') }}"
                                    class="text-sm font-semibold text-gray-600 transition hover:text-indigo-600">Admin
                                    Panel</a>
                            @endif
                        @endauth
                    </div>

                    <!-- RIGHT ACTIONS -->
                    <div class="hidden items-center gap-4 md:flex">
                        @auth
                            <a href="{{ route('events.create') }}"
                                class="flex items-center gap-1 text-sm font-bold text-gray-900 transition hover:text-indigo-600">
                                <span>+ Host Event</span>
                            </a>
                            <!-- Profile Dropdown -->
                            <div class="relative ml-3" x-data="{ open: false }">
                                <button @click="open = !open" @click.away="open = false"
                                    class="flex items-center gap-2 rounded-full border border-gray-200 bg-white p-1 pr-3 transition hover:shadow-md">
                                    <div
                                        class="flex h-8 w-8 items-center justify-center rounded-full bg-indigo-100 text-sm font-bold text-indigo-700">
                                        {{ substr(Auth::user()->name, 0, 1) }}
                                    </div>
                                    <span
                                        class="text-sm font-bold text-gray-700">{{ explode(' ', Auth::user()->name)[0] }}</span>
                                    <svg class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>

                                <!-- Dropdown Menu -->
                                <div x-show="open" x-transition:enter="transition ease-out duration-100"
                                    x-transition:enter-start="transform opacity-0 scale-95"
                                    x-transition:enter-end="transform opacity-100 scale-100"
                                    x-transition:leave="transition ease-in duration-75"
                                    x-transition:leave-start="transform opacity-100 scale-100"
                                    x-transition:leave-end="transform opacity-0 scale-95"
                                    class="absolute right-0 mt-2 w-48 origin-top-right rounded-xl bg-white py-1 shadow-xl ring-1 ring-black ring-opacity-5 focus:outline-none"
                                    style="display: none;">
                                    <a href="{{ route('profile.edit') }}"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Your Profile</a>
                                    <a href="{{ route('tickets.index') }}"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">My Tickets</a>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit"
                                            class="block w-full px-4 py-2 text-left text-sm font-medium text-red-600 hover:bg-red-50">Sign
                                            out</button>
                                    </form>
                                </div>
                            </div>
                        @else
                            <a href="{{ route('login') }}"
                                class="text-sm font-bold text-gray-600 transition hover:text-indigo-600">Log in</a>
                            <a href="{{ route('register') }}"
                                class="rounded-full bg-indigo-600 px-6 py-2.5 text-sm font-bold text-white shadow-lg shadow-indigo-200 transition-all hover:-translate-y-0.5 hover:bg-indigo-700 hover:shadow-indigo-300">
                                Sign up free
                            </a>
                        @endauth
                    </div>

                    <!-- MOBILE HAMBURGER -->
                    <div class="flex items-center md:hidden">
                        <button @click="open = !open" class="text-gray-500 hover:text-gray-900 focus:outline-none">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16" />
                                <path x-show="open" x-cloak stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- MOBILE MENU -->
            <div x-show="open" x-collapse x-cloak class="border-t border-gray-100 bg-white md:hidden">
                <div class="space-y-1 px-4 py-4">
                    <a href="{{ route('events.index') }}"
                        class="block rounded-lg px-3 py-2 text-base font-semibold text-gray-900 hover:bg-gray-50">Browse
                        Events</a>
                    <a href="{{ route('about') }}"
                        class="block rounded-lg px-3 py-2 text-base font-semibold text-gray-900 hover:bg-gray-50">About
                        Us</a>
                    @auth
                        <a href="{{ route('events.create') }}"
                            class="block rounded-lg px-3 py-2 text-base font-semibold text-indigo-600 hover:bg-indigo-50">+
                            Create Event</a>
                        <a href="{{ route('tickets.index') }}"
                            class="block rounded-lg px-3 py-2 text-base font-semibold text-gray-900 hover:bg-gray-50">My
                            Tickets</a>
                        <form method="POST" action="{{ route('logout') }}" class="mt-4 border-t border-gray-100 pt-4">
                            @csrf
                            <button
                                class="block w-full rounded-lg px-3 py-2 text-left text-base font-semibold text-red-600 hover:bg-red-50">Log
                                Out</button>
                        </form>
                    @else
                        <div class="mt-4 grid grid-cols-2 gap-4">
                            <a href="{{ route('login') }}"
                                class="flex items-center justify-center rounded-lg border border-gray-300 bg-white px-4 py-2 text-base font-semibold text-gray-700 shadow-sm hover:bg-gray-50">Log
                                in</a>
                            <a href="{{ route('register') }}"
                                class="flex items-center justify-center rounded-lg bg-indigo-600 px-4 py-2 text-base font-semibold text-white shadow-sm hover:bg-indigo-700">Sign
                                up</a>
                        </div>
                    @endauth
                </div>
            </div>
        </nav>

        <!-- HERO SECTION -->
        <div class="relative overflow-hidden pb-20 pt-32 sm:pb-24 sm:pt-40">
            <!-- Background Blob -->
            <div class="absolute left-1/2 top-0 z-[-1] h-full w-full -translate-x-1/2">
                <div
                    class="animate-blob absolute left-1/4 top-0 h-[500px] w-[500px] rounded-full bg-indigo-100 opacity-30 mix-blend-multiply blur-3xl filter">
                </div>
                <div
                    class="animate-blob animation-delay-2000 absolute right-1/4 top-0 h-[500px] w-[500px] rounded-full bg-purple-100 opacity-30 mix-blend-multiply blur-3xl filter">
                </div>
            </div>

            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <div class="mx-auto max-w-3xl text-center">
                    <div
                        class="mb-6 inline-flex items-center rounded-full border border-indigo-100 bg-white px-3 py-1 text-sm font-medium text-indigo-600 shadow-sm ring-4 ring-indigo-50/50">
                        <span class="mr-2 flex h-2 w-2 animate-pulse rounded-full bg-indigo-600"></span>
                        Now available in your city
                    </div>
                    <h1 class="mb-6 text-5xl font-extrabold tracking-tight text-gray-900 sm:text-7xl">
                        Discover legit events  <br>
                        <span
                            class="bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">that matter
                            to you.</span>
                    </h1>
                    <p class="mt-6 text-lg leading-8 text-gray-600">
                        Join thousands of people organizing and attending unique experiences. From tech workshops to
                        underground music festivals, find your crowd here.
                    </p>
                    <div class="mt-10 flex items-center justify-center gap-x-6">
                        <a href="{{ route('events.index') }}"
                            class="rounded-full bg-indigo-600 px-8 py-3.5 text-base font-bold text-white shadow-xl shadow-indigo-200 transition hover:-translate-y-1 hover:bg-indigo-700">
                            Explore Events
                        </a>
                        <a href="{{ route('about') }}"
                            class="flex items-center gap-1 text-base font-bold text-gray-900 transition hover:text-indigo-600">
                            Learn more <span aria-hidden="true">→</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- STATS BAR -->
        <div class="border-y border-gray-100 bg-white">
            <div class="mx-auto max-w-7xl px-6 py-12 lg:px-8">
                <dl class="grid grid-cols-1 gap-x-8 gap-y-16 text-center lg:grid-cols-3">
                    <div class="mx-auto flex max-w-xs flex-col gap-y-2">
                        <dt class="text-base leading-7 text-gray-600">Active Events</dt>
                        <dd class="order-first text-3xl font-bold tracking-tight text-gray-900 sm:text-5xl">2,000+</dd>
                    </div>
                    <div class="mx-auto flex max-w-xs flex-col gap-y-2">
                        <dt class="text-base leading-7 text-gray-600">People That Attended</dt>
                        <dd class="order-first text-3xl font-bold tracking-tight text-gray-900 sm:text-5xl">85k+</dd>
                    </div>
                    <div class="mx-auto flex max-w-xs flex-col gap-y-2">
                        <dt class="text-base leading-7 text-gray-600">Tickets Sold</dt>
                        <dd class="order-first text-3xl font-bold tracking-tight text-gray-900 sm:text-5xl">120k</dd>
                    </div>
                </dl>
            </div>
        </div>

        <!-- FEATURES -->
        <div class="bg-gray-50/50 py-24">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <div class="mx-auto mb-16 max-w-2xl lg:text-center">
                    <h2 class="text-base font-bold uppercase leading-7 tracking-wide text-indigo-600">Why Micmash?</h2>
                    <p class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Everything you need to
                        host & join.</p>
                </div>

                <div class="grid grid-cols-1 gap-10 md:grid-cols-3">
                    <!-- Feature 1 -->
                    <div
                        class="relative rounded-3xl border border-gray-100 bg-white p-8 shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl">
                        <div
                            class="mb-6 flex h-12 w-12 items-center justify-center rounded-2xl bg-indigo-100 text-indigo-600">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                        </div>
                        <h3 class="mb-3 text-xl font-bold text-gray-900">Host with Ease</h3>
                        <p class="leading-relaxed text-gray-500">Create professional event pages in minutes. Manage
                            guest lists, speakers, and ticketing all in one place.</p>
                    </div>

                    <!-- Feature 2 -->
                    <div
                        class="relative rounded-3xl border border-gray-100 bg-white p-8 shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl">
                        <div
                            class="mb-6 flex h-12 w-12 items-center justify-center rounded-2xl bg-purple-100 text-purple-600">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <h3 class="mb-3 text-xl font-bold text-gray-900">Smart RSVP</h3>
                        <p class="leading-relaxed text-gray-500">Bringing friends? Our smart RSVP system handles group
                            bookings and calculates costs instantly.</p>
                    </div>

                    <!-- Feature 3 -->
                    <div
                        class="relative rounded-3xl border border-gray-100 bg-white p-8 shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl">
                        <div
                            class="mb-6 flex h-12 w-12 items-center justify-center rounded-2xl bg-green-100 text-green-600">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="mb-3 text-xl font-bold text-gray-900">Secure Payments</h3>
                        <p class="leading-relaxed text-gray-500">Integrated directly with Paystack for seamless, secure
                            transactions. No hidden fees.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- FAQ SECTION -->
        <div class="bg-white py-24">
            <div class="mx-auto max-w-3xl px-6 lg:px-8">
                <h2 class="mb-12 text-center text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">
                    Frequently Asked Questions
                </h2>

                <div class="space-y-4">

                    <!-- 1. Cost -->
                    <div class="group cursor-pointer rounded-2xl bg-gray-50 p-6 transition-all hover:bg-indigo-50"
                        x-data="{ open: false }" @click="open = !open">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-semibold text-gray-900">Is it free to host events?</h3>
                            <span class="ml-6 flex-shrink-0">
                                <svg class="h-6 w-6 text-gray-400 transition-transform group-hover:text-indigo-600"
                                    :class="{ 'rotate-180': open }" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </span>
                        </div>
                        <div x-show="open" x-collapse style="display: none;"
                            class="mt-4 leading-relaxed text-gray-600">
                            Yes! Creating an account and hosting events is completely free. We only charge a small
                            transaction fee for paid tickets sold through our platform.
                        </div>
                    </div>

                    <!-- 2. Guests -->
                    <div class="group cursor-pointer rounded-2xl bg-gray-50 p-6 transition-all hover:bg-indigo-50"
                        x-data="{ open: false }" @click="open = !open">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-semibold text-gray-900">Can I bring guests?</h3>
                            <span class="ml-6 flex-shrink-0">
                                <svg class="h-6 w-6 text-gray-400 transition-transform group-hover:text-indigo-600"
                                    :class="{ 'rotate-180': open }" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </span>
                        </div>
                        <div x-show="open" x-collapse style="display: none;"
                            class="mt-4 leading-relaxed text-gray-600">
                            Absolutely. When you RSVP, you can use our "Plus One" feature to add up to 5 guests to your
                            reservation in a single click. The total price (if applicable) will calculate automatically.
                        </div>
                    </div>

                    <!-- 3. Payments (New) -->
                    <div class="group cursor-pointer rounded-2xl bg-gray-50 p-6 transition-all hover:bg-indigo-50"
                        x-data="{ open: false }" @click="open = !open">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-semibold text-gray-900">What payment methods do you accept?</h3>
                            <span class="ml-6 flex-shrink-0">
                                <svg class="h-6 w-6 text-gray-400 transition-transform group-hover:text-indigo-600"
                                    :class="{ 'rotate-180': open }" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </span>
                        </div>
                        <div x-show="open" x-collapse style="display: none;"
                            class="mt-4 leading-relaxed text-gray-600">
                            We use <strong>Paystack</strong> to ensure secure transactions. You can pay using your Debit
                            Card, Bank Transfer, USSD, or Visa QR.
                        </div>
                    </div>

                    <!-- 4. Pending Events (New) -->
                    <div class="group cursor-pointer rounded-2xl bg-gray-50 p-6 transition-all hover:bg-indigo-50"
                        x-data="{ open: false }" @click="open = !open">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-semibold text-gray-900">Why is my event "Pending"?</h3>
                            <span class="ml-6 flex-shrink-0">
                                <svg class="h-6 w-6 text-gray-400 transition-transform group-hover:text-indigo-600"
                                    :class="{ 'rotate-180': open }" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </span>
                        </div>
                        <div x-show="open" x-collapse style="display: none;"
                            class="mt-4 leading-relaxed text-gray-600">
                            To maintain a safe community, all created events go through a quick moderation process. Our
                            admins typically review and approve events within 24 hours.
                        </div>
                    </div>

                    <!-- 5. Editing (New) -->
                    <div class="group cursor-pointer rounded-2xl bg-gray-50 p-6 transition-all hover:bg-indigo-50"
                        x-data="{ open: false }" @click="open = !open">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-semibold text-gray-900">Can I edit my event details later?</h3>
                            <span class="ml-6 flex-shrink-0">
                                <svg class="h-6 w-6 text-gray-400 transition-transform group-hover:text-indigo-600"
                                    :class="{ 'rotate-180': open }" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </span>
                        </div>
                        <div x-show="open" x-collapse style="display: none;"
                            class="mt-4 leading-relaxed text-gray-600">
                            Yes, as the organizer, you can edit your event details (Date, Time, Description) at any time
                            from your dashboard. However, you cannot change the ticket price once sales have started.
                        </div>
                    </div>

                    <!-- 6. Refunds (New) -->
                    <div class="group cursor-pointer rounded-2xl bg-gray-50 p-6 transition-all hover:bg-indigo-50"
                        x-data="{ open: false }" @click="open = !open">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-semibold text-gray-900">What is the refund policy?</h3>
                            <span class="ml-6 flex-shrink-0">
                                <svg class="h-6 w-6 text-gray-400 transition-transform group-hover:text-indigo-600"
                                    :class="{ 'rotate-180': open }" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </span>
                        </div>
                        <div x-show="open" x-collapse style="display: none;"
                            class="mt-4 leading-relaxed text-gray-600">
                            Refund policies are set by the individual event organizers. If an event is cancelled, you
                            will be refunded automatically. For personal cancellations, please contact the organizer
                            directly via the event page.
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- FOOTER -->
        <footer class="bg-gray-900 py-16 text-white">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <div class="mb-12 grid grid-cols-1 gap-12 md:grid-cols-4">
                    <div class="col-span-1 md:col-span-2">
                        <span class="mb-4 block text-2xl font-bold tracking-tight">Micmash</span>
                        <p class="max-w-md leading-relaxed text-gray-400">
                            The modern way to discover and host events. Built for communities, optimized for connection.
                        </p>
                    </div>
                    <div>
                        <h3 class="mb-4 text-lg font-bold">Platform</h3>
                        <ul class="space-y-3 text-gray-400">
                            <li><a href="{{ route('events.index') }}" class="transition hover:text-white">Browse
                                    Events</a></li>
                            <li><a href="{{ route('about') }}" class="transition hover:text-white">About Us</a></li>
                            <li><a href="#" class="transition hover:text-white">Pricing</a></li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="mb-4 text-lg font-bold">Support</h3>
                        <ul class="space-y-3 text-gray-400">
                            <li><a href="#" class="transition hover:text-white">Help Center</a></li>
                            <li><a href="#" class="transition hover:text-white">Terms of Service</a></li>
                            <li><a href="#" class="transition hover:text-white">Privacy Policy</a></li>
                        </ul>
                    </div>
                </div>
                <div
                    class="flex flex-col items-center justify-between border-t border-gray-800 pt-8 text-sm text-gray-500 md:flex-row">
                    <p>&copy; {{ date('Y') }} Micmash Inc. All rights reserved.</p>
                    <div class="mt-4 flex space-x-6 md:mt-0">
                        <a href="#" class="transition hover:text-white">Twitter</a>
                        <a href="#" class="transition hover:text-white">Instagram</a>
                        <a href="#" class="transition hover:text-white">LinkedIn</a>
                    </div>
                </div>
            </div>
        </footer>

    </body>

</html>
