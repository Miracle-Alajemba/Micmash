<x-app-layout>
    <!-- HERO SECTION -->
    <div class="relative bg-gradient-to-r from-indigo-600 to-purple-800 py-16 sm:py-24">
        <div class="absolute inset-0 bg-black opacity-30"></div>
        <div class="relative mx-auto max-w-7xl px-4 text-center sm:px-6 lg:px-8">
            <h1 class="font-inter text-3xl font-extrabold text-white sm:text-5xl sm:tracking-tight lg:text-6xl">
                Discover Amazing Events
            </h1>
            <p class="sm-text-1xl mx-auto mt-4 max-w-2xl font-inter text-white">
                Join workshops, conferences, and meetups happening around you.
            </p>

            <!-- SEARCH BAR -->
            <div class="mx-auto mt-10 max-w-6xl">
                <form action="{{ route('events.index') }}" method="GET"
                    class="flex flex-col items-center gap-2 rounded-3xl bg-white p-2 shadow-2xl md:flex-row md:gap-0 md:rounded-full">

                    <div class="mb-2 w-full flex-grow px-4 md:mb-0 md:w-auto">
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Search events, locations..."
                            class="w-full border-0 text-lg text-gray-800 placeholder-gray-400 focus:ring-0">
                    </div>

                    <div
                        class="mb-2 w-full border-t border-gray-200 px-4 py-2 md:mb-0 md:w-auto md:border-l md:border-t-0 md:py-0">
                        <select name="category"
                            class="w-full cursor-pointer border-0 bg-transparent font-inter font-medium text-gray-600 focus:ring-0">
                            <option value="">All Categories</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ request('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit"
                        class="w-full transform rounded-full bg-indigo-600 px-8 py-3 text-lg font-bold text-white transition hover:scale-105 hover:bg-indigo-700 md:w-auto">
                        Find Events
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- MAIN CONTENT -->
    <div class="min-h-screen bg-gray-50 py-12">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mb-8 flex flex-col items-start gap-4 sm:flex-row sm:items-end sm:justify-between">
                <h2 class="font-roboto font-inter text-3xl font-bold text-indigo-900 sm:text-4xl">Upcoming Events</h2>
                @auth
                    <a href="{{ route('events.create') }}"
                        class="flex items-center rounded-lg bg-indigo-50 px-4 py-2 font-semibold text-indigo-600 transition hover:bg-indigo-100 hover:text-indigo-800">
                        + Create Event
                    </a>
                @endauth
            </div>

            <!-- EVENT GRID -->
            <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
                @forelse($events as $event)
                    <div
                        class="group flex transform flex-col overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl">

                        <!-- Image -->
                        <div class="relative h-48 overflow-hidden">
                            <span
                                class="absolute right-4 top-4 z-10 rounded-full bg-white/90 px-3 py-1 text-xs font-bold text-indigo-700 shadow-sm backdrop-blur-sm">
                                {{ $event->category->name }}
                            </span>

                            {{-- ROBUST IMAGE LOADING FIX --}}
                            @if ($event->image)
                                <img src="{{ asset('storage/eventimages/' . $event->image) }}"
                                    class="h-full w-full object-cover transition duration-500" alt="Event Image">
                            @else
                                <div
                                    class="flex h-full w-full items-center justify-center bg-gradient-to-br from-indigo-50 to-purple-50 text-indigo-200">
                                    <svg class="h-16 w-16" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                            @endif
                        </div>

                        <!-- Content -->
                        <div class="flex flex-1 flex-col p-6">
                            <div class="mb-2 flex items-center text-sm font-semibold text-indigo-600">
                                <svg class="mr-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                                {{ \Carbon\Carbon::parse($event->date)->format('D, M j • g:i A') }}
                            </div>

                            <h3
                                class="font-roboto mb-2 text-xl font-bold leading-tight text-gray-900 transition group-hover:text-indigo-600">
                                <a href="{{ route('events.show', $event) }}">
                                    {{ $event->title }}
                                </a>
                            </h3>

                            <p class="font-roboto mb-4 line-clamp-2 flex-grow text-sm text-gray-500">
                                {{ $event->location }}
                            </p>

                            <!-- Footer: User & Action -->
                            <div class="mt-auto flex items-center justify-between border-t border-gray-100 pt-4">
                                <div class="flex items-center">
                                    <div
                                        class="flex h-8 w-8 items-center justify-center rounded-full bg-gray-200 text-xs font-bold uppercase text-gray-600">
                                        {{ substr($event->user->name, 0, 1) }}
                                    </div>
                                    <span class="ml-2 text-xs text-gray-500">By
                                        {{ Str::limit($event->user->name, 10) }}</span>
                                </div>
                                <span class="flex items-center text-xs font-medium text-gray-400">
                                    <!-- FIXED: Added icon for attendees -->
                                    <svg class="mr-1 h-3 w-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z">
                                        </path>
                                    </svg>
                                    {{ $event->rsvps_count ?? 0 }} going
                                </span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full flex flex-col items-center justify-center py-12 text-center">
                        <div class="mb-4 rounded-full bg-indigo-50 p-4">
                            <svg class="h-10 w-10 text-indigo-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900">No events found</h3>
                        <p class="text-gray-500">Try adjusting your search or filter.</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-8">
                {{ $events->withQueryString()->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
