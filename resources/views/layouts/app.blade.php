<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Micmash') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Another Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap"
            rel="stylesheet">
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="font-sans antialiased">

        <!-- Wrapper to keep footer at bottom -->
        <div class="flex min-h-screen flex-col justify-between bg-gray-100">

            <!-- Top Content -->
            <div>
                @include('layouts.navigation')

                @isset($header)
                    <header class="bg-indigo-700">
                        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endisset

                <main>
                    {{ $slot }}
                </main>
            </div>


            <!-- ✨ This is where the footer started ✨ -->
            <footer class="mt-12 bg-indigo-900 text-gray-100">
                <div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">

                    <!-- Grid Layout -->
                    <div class="grid grid-cols-1 gap-8 md:grid-cols-4">

                        <!-- Column 1: Brand -->
                        <div class="space-y-4">
                            <h3 class="text-2xl font-bold text-white">EventApp</h3>
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
                                <li><a href="{{ route('events.index') }}"
                                        class="transition hover:text-indigo-400">Browse Events</a></li>
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

        </div>
    </body>

</html>
