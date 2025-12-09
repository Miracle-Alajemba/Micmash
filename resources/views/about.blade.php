<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-100">
            {{ __('About Us') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">

            <!-- Hero Section -->
            <div class="mb-10 overflow-hidden rounded-lg bg-indigo-600 p-10 text-center text-white shadow-xl">
                <h1 class="mb-4 text-4xl font-bold">Connecting People Through Events</h1>
                <p class="mx-auto max-w-2xl text-lg text-indigo-100">
                    We are the premier platform for discovering local meetups, workshops, and conferences.
                    Join our community and start creating memories today.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-8 md:grid-cols-2">

                <!-- Our Mission -->
                <div class="rounded-lg bg-white p-8 shadow-sm">
                    <div class="mb-4 text-indigo-600">
                        <svg class="h-10 w-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="mb-4 text-2xl font-bold text-gray-900">Our Mission</h3>
                    <p class="leading-relaxed text-gray-600">
                        Our mission is to democratize event management. Whether you are hosting a small book club or a
                        large tech
                        conference,
                        we provide the tools you need to reach your audience and manage your attendees effortlessly.
                    </p>
                </div>

                <!-- Why Choose Us -->
                <div class="rounded-lg bg-white p-8 shadow-sm">
                    <div class="mb-4 text-indigo-600">
                        <svg class="h-10 w-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="mb-4 text-2xl font-bold text-gray-900">Community First</h3>
                    <p class="leading-relaxed text-gray-600">
                        We believe in the power of community. Our platform is designed to foster connections,
                        encourage networking, and bring people together in real life (and virtually) to share passions
                        and skills.
                    </p>
                </div>

            </div>

            <!-- Stats Section -->
            <div class="mt-10 rounded-lg bg-white p-8 shadow-sm">
                <div
                    class="grid grid-cols-1 gap-6 divide-y divide-gray-200 text-center md:grid-cols-3 md:divide-x md:divide-y-0">
                    <div class="p-4">
                        <div class="mb-1 text-4xl font-bold text-indigo-600">100+</div>
                        <div class="font-medium text-gray-500">Events Hosted</div>
                    </div>
                    <div class="p-4">
                        <div class="mb-1 text-4xl font-bold text-indigo-600">500+</div>
                        <div class="font-medium text-gray-500">Active Users</div>
                    </div>
                    <div class="p-4">
                        <div class="mb-1 text-4xl font-bold text-indigo-600">50+</div>
                        <div class="font-medium text-gray-500">Cities</div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
