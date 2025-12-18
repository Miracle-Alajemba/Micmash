<x-app-layout>
    <div class="min-h-screen bg-gray-50 py-12">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <!-- Breadcrumb -->
            <nav class="mb-6 flex text-sm text-gray-500">
                <a href="{{ route('events.index') }}" class="transition hover:text-indigo-600">Events</a>
                <span class="mx-2">/</span>
                <span class="font-medium text-gray-900">{{ Str::limit($event->title, 30) }}</span>
            </nav>

            <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
                <!-- LEFT COLUMN (Main Content) -->
                <div class="space-y-8 lg:col-span-2">
                    <!-- Main Card -->
                    <div class="overflow-hidden rounded-2xl bg-white shadow-sm">
                        <!-- Image -->
                        <div class="relative h-64 sm:h-96">
                            @if ($event->image)
                                <img src="{{ asset('storage/eventimages/' . $event->image) }}" alt="{{ $event->title }}"
                                    class="h-full w-full transform object-cover transition duration-500 hover:scale-105">
                            @else
                                <div class="flex h-full w-full items-center justify-center bg-gray-200 text-gray-400">
                                    <span class="flex flex-col items-center">
                                        <svg class="mb-2 h-12 w-12 opacity-50" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                        No Cover Image
                                    </span>
                                </div>
                            @endif

                            <div class="absolute left-4 top-4">
                                <span
                                    class="rounded-full bg-white/90 px-3 py-1 text-sm font-bold text-indigo-700 shadow-sm backdrop-blur">
                                    {{ $event->category->name }}
                                </span>
                            </div>
                        </div>


                        <!-- Content -->
                        <div class="p-6 sm:p-8">
                            <h1 class="mb-6 text-3xl font-extrabold text-gray-900 sm:text-4xl">{{ $event->title }}</h1>
                            <!-- Description -->
                            <div class="prose max-w-none leading-relaxed text-gray-600">
                                {!! nl2br(e($event->description)) !!}
                            </div>

                            <!-- Speakers Section -->
                            <div class="mt-10 border-t pt-8">
                                <div class="mb-6 flex items-end justify-between">
                                    <h3 class="text-xl font-bold text-gray-900">Speakers</h3>
                                    @if (Auth::check() && (Auth::id() === $event->user_id || Auth::user()->is_admin))
                                        <a href="{{ route('events.speakers.create', $event) }}"
                                            class="text-sm font-medium text-indigo-600 hover:text-indigo-800">
                                            + Add Speaker
                                        </a>
                                    @endif
                                </div>

                                @if ($event->speakers->count() > 0)
                                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                        @foreach ($event->speakers as $speaker)
                                            <div
                                                class="group relative flex items-center space-x-4 rounded-xl border border-gray-100 bg-gray-50 p-4">
                                                @if ($speaker->image)
                                                    <img src="{{ asset('storage/speakers/' . $speaker->image) }}"
                                                        class="h-16 w-16 rounded-full object-cover shadow-sm ring-2 ring-white">
                                                @else
                                                    <div
                                                        class="flex h-16 w-16 items-center justify-center rounded-full bg-indigo-100 text-xl font-bold text-indigo-600">
                                                        {{ substr($speaker->name, 0, 1) }}
                                                    </div>
                                                @endif
                                                <div>
                                                    <h4 class="font-bold text-gray-900">{{ $speaker->name }}</h4>
                                                    <p class="text-sm text-indigo-600">{{ $speaker->role }}</p>
                                                </div>

                                                @if (Auth::check() && (Auth::id() === $event->user_id || Auth::user()->is_admin))
                                                    <div
                                                        class="absolute right-2 top-2 opacity-0 transition group-hover:opacity-100">
                                                        <a href="{{ route('events.speakers.edit', $speaker) }}"
                                                            class="mr-2 text-gray-400 hover:text-indigo-600">✎</a>
                                                        <form action="{{ route('events.speakers.destroy', $speaker) }}"
                                                            method="POST" class="inline"
                                                            onsubmit="return confirm('Delete?');">
                                                            @csrf @method('DELETE')
                                                            <button
                                                                class="text-gray-400 hover:text-red-600">&times;</button>
                                                        </form>
                                                    </div>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <p class="text-sm italic text-gray-400">Speaker details coming soon.</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Comments Section -->
                    <div class="rounded-2xl bg-white p-6 shadow-sm sm:p-8">
                        <h3 class="mb-6 text-xl font-bold text-gray-900">Discussion ({{ $event->comments->count() }})
                        </h3>
                        @auth
                            <form action="{{ route('events.comment', $event) }}" method="POST" class="mb-8 flex gap-4">
                                @csrf
                                <div class="flex-shrink-0">
                                    <div
                                        class="flex h-10 w-10 items-center justify-center rounded-full bg-gray-200 font-bold text-gray-600">
                                        {{ substr(Auth::user()->name, 0, 1) }}
                                    </div>
                                </div>
                                <div class="flex-grow">
                                    <textarea name="content" rows="2"
                                        class="w-full rounded-xl border-gray-300 bg-gray-50 px-4 py-3 focus:border-indigo-500 focus:ring-indigo-500"
                                        placeholder="Add a comment..."></textarea>
                                    <div class="mt-2 flex justify-end">
                                        <button
                                            class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-medium text-white transition hover:bg-indigo-700">Post</button>
                                    </div>
                                </div>
                            </form>
                        @endauth

                        <div class="space-y-6">
                            @forelse($event->comments as $comment)
                                <div class="flex gap-4">
                                    <div class="flex-shrink-0">
                                        <div
                                            class="flex h-10 w-10 items-center justify-center rounded-full bg-gray-100 text-sm font-bold text-gray-500">
                                            {{ substr($comment->user->name, 0, 1) }}
                                        </div>
                                    </div>
                                    <div>
                                        <div class="rounded-2xl rounded-tl-none bg-gray-50 px-4 py-3">
                                            <span
                                                class="block text-sm font-bold text-gray-900">{{ $comment->user->name }}</span>
                                            <p class="mt-1 text-sm text-gray-700">{{ $comment->content }}</p>
                                        </div>
                                        <span
                                            class="ml-2 mt-1 block text-xs text-gray-400">{{ $comment->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                            @empty
                                <div class="py-4 text-center text-sm text-gray-500">No comments yet.</div>
                            @endforelse
                        </div>
                    </div>

                </div>

                <!-- RIGHT COLUMN (Sticky Sidebar) -->
                <div class="lg:col-span-1">
                    <div class="sticky top-6 space-y-6">
                        <!-- Event Info Card -->
                        <div class="rounded-2xl border border-gray-100 bg-white p-6 shadow-lg">
                            <!-- Date -->
                            <div class="mb-6 flex items-start">
                                <div class="mr-4 rounded-lg bg-indigo-50 p-3 text-indigo-600">
                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Date & Time</p>
                                    <p class="font-bold text-gray-900">
                                        {{ \Carbon\Carbon::parse($event->date)->format('F j, Y') }}
                                    </p>
                                    <p class="text-sm text-gray-600">
                                        {{ \Carbon\Carbon::parse($event->time)->format('g:i A') }}
                                    </p>
                                </div>
                            </div>

                            <!-- Location -->
                            <div class="mb-8 flex items-start">
                                <div class="mr-4 rounded-lg bg-indigo-50 p-3 text-indigo-600">
                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                        </path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Location</p>
                                    <p class="font-bold text-gray-900">{{ $event->location }}</p>
                                </div>
                            </div>

                            <!-- Event Link Section -->
                            @if ($event->url)
                                <div class="mb-8 flex items-start">
                                    <div class="mr-4 rounded-lg bg-indigo-50 p-3 text-indigo-600">
                                        <svg class="h-6 w-6" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1">
                                            </path>
                                        </svg>
                                    </div>
                                    <div class="overflow-hidden">
                                        <p class="text-sm font-medium text-gray-500">Event Link</p>
                                        <a href="{{ $event->url }}" target="_blank" rel="noopener noreferrer"
                                            class="block truncate font-bold text-indigo-600 transition hover:text-indigo-800 hover:underline">
                                            Visit Website &rarr;
                                        </a>
                                    </div>
                                </div>
                            @endif

                            <!-- RSVP ACTION CARD -->
                            <div class="rounded-xl border border-gray-100 bg-gray-50 p-5 shadow-inner">
                                @auth
                                    @php
                                        // Define variables for Authenticated Users
                                        $userRsvp = $event->rsvps->where('user_id', auth()->id())->first();
                                        $currentGuests = $userRsvp ? $userRsvp->guests_count : 0;
                                        $isPaid = $event->price > 0;
                                    @endphp

                                    <!-- HEADER TEXT -->
                                    <div class="mb-4 text-center">
                                        @if ($userRsvp)
                                            <div
                                                class="mb-2 inline-flex items-center rounded-full bg-green-100 px-3 py-1 text-xs font-bold text-green-700">
                                                ✅ You are going
                                            </div>
                                        @else
                                            <p class="text-sm font-bold text-gray-700">Want to join?</p>
                                            @if ($isPaid)
                                                <span
                                                    class="mt-1 inline-block rounded bg-yellow-100 px-2 py-1 text-xs font-bold text-yellow-800">
                                                    Ticket Price: ₦{{ number_format($event->price) }} / person
                                                </span>
                                            @else
                                                <span
                                                    class="mt-1 inline-block rounded bg-blue-100 px-2 py-1 text-xs font-bold text-blue-800">
                                                    Free Entry
                                                </span>
                                            @endif
                                        @endif
                                        <p class="mt-2 text-xs text-gray-500">Bringing friends? (Max 5)</p>
                                    </div>

                                    <!-- THE FORM -->
                                    {{-- If user hasn't joined AND it costs money, send to Payment. Otherwise, standard RSVP --}}
                                    <form
                                        action="{{ $isPaid && !$userRsvp ? route('payment.initialize', $event) : route('events.rsvp', $event) }}"
                                        method="POST">
                                        @csrf

                                        <!-- STEPPER UI ( -  0  + ) -->
                                        <div class="mb-4 flex items-center justify-center space-x-3">
                                            <!-- MINUS BUTTON -->
                                            <button type="button" onclick="updateGuestCount(-1)"
                                                class="flex h-10 w-10 items-center justify-center rounded-full border border-gray-300 bg-white text-lg font-bold text-gray-600 shadow-sm transition hover:border-indigo-500 hover:bg-gray-100 hover:text-indigo-600">
                                                -
                                            </button>

                                            <!-- THE HIDDEN NUMBER INPUT -->
                                            <div class="relative">
                                                <span class="absolute left-0 top-0 p-1 text-xs font-bold text-gray-400">Me
                                                    +</span>
                                                <input type="number" id="guest_input" name="guests_count"
                                                    value="{{ $currentGuests }}" min="0" max="5" readonly
                                                    class="h-12 w-20 rounded-lg border-2 border-indigo-100 bg-white text-center text-xl font-bold text-indigo-700 focus:border-indigo-500 focus:ring-0">
                                            </div>

                                            <!-- PLUS BUTTON -->
                                            <button type="button" onclick="updateGuestCount(1)"
                                                class="flex h-10 w-10 items-center justify-center rounded-full border border-gray-300 bg-white text-lg font-bold text-gray-600 shadow-sm transition hover:border-indigo-500 hover:bg-gray-100 hover:text-indigo-600">
                                                +
                                            </button>
                                        </div>

                                        <!-- SUBMIT BUTTON -->
                                        <button id="submit_btn"
                                            class="w-full transform rounded-xl bg-indigo-600 py-3 text-lg font-bold text-white shadow-md transition hover:bg-indigo-700 hover:shadow-lg active:scale-95">
                                            @if ($userRsvp)
                                                Update Guests
                                            @else
                                                @if ($isPaid)
                                                    Pay <span
                                                        id="total_price_display">₦{{ number_format($event->price) }}</span>
                                                @else
                                                    Join Event
                                                @endif
                                            @endif
                                        </button>
                                    </form>

                                    <!-- LEAVE BUTTON (Only if joined) -->
                                    @if ($userRsvp)
                                        <form action="{{ route('events.rsvp.destroy', $event) }}" method="POST"
                                            class="mt-3 text-center">
                                            @csrf @method('DELETE')
                                            <button
                                                class="text-xs font-medium text-red-500 hover:text-red-700 hover:underline">
                                                Cancel my reservation
                                            </button>
                                        </form>
                                    @endif
                                @else
                                    <!-- GUEST STATE -->
                                    <div class="text-center">
                                        <p class="mb-3 text-sm text-gray-600">Join the community to RSVP!</p>
                                        <a href="{{ route('login') }}"
                                            class="block w-full rounded-xl bg-gray-900 py-3 font-bold text-white transition hover:bg-black">
                                            Login to Join
                                        </a>
                                    </div>
                                @endauth
                            </div>
                        </div>

                        <!-- Admin/Owner Controls -->
                        @if (Auth::check() && (Auth::id() === $event->user_id || Auth::user()->is_admin))
                            <div class="rounded-2xl border border-gray-100 bg-white p-4 shadow-sm">
                                <h4 class="mb-3 text-xs font-bold uppercase tracking-wider text-gray-400">Admin
                                    Controls</h4>
                                <div class="flex gap-2">
                                    <a href="{{ route('events.edit', $event) }}"
                                        class="flex-1 rounded-lg bg-gray-100 py-2 text-center text-sm font-medium text-gray-700 hover:bg-gray-200">
                                        Edit
                                    </a>
                                    <form action="{{ route('events.destroy', $event) }}" method="POST"
                                        class="flex-1" onsubmit="return confirm('Delete event?');">
                                        @csrf @method('DELETE')
                                        <button
                                            class="w-full rounded-lg bg-red-50 py-2 text-sm font-medium text-red-600 hover:bg-red-100">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endif

                        <!-- Organizer -->
                        <div class="flex items-center justify-center space-x-2 text-sm text-gray-500">
                            <span>Organized by</span>
                            <span class="font-bold text-gray-900">{{ $event->user->name }}</span>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JAVASCRIPT FOR MATH AND LOGIC -->
    <script>
        @auth
        // VARIABLES FOR LOGGED IN USERS
        const eventPrice = {{ $event->price ?? 0 }};
        // Logic: Is it paid? AND User is NOT on the list?
        const isPaidEvent = {{ $event->price > 0 && !($userRsvp ?? false) ? 'true' : 'false' }};
        @else
            // DEFAULTS FOR GUESTS
            const eventPrice = 0;
            const isPaidEvent = false;
        @endauth

        function updateGuestCount(change) {
            // 1. Get the input field
            let input = document.getElementById('guest_input');
            if (!input) return;

            let currentValue = parseInt(input.value);

            // 2. Calculate new value
            let newValue = currentValue + change;

            // 3. Enforce limits (Min 0, Max 5)
            if (newValue >= 0 && newValue <= 5) {
                input.value = newValue;

                // 4. Update Price Display (Only if Paid & New RSVP)
                if (isPaidEvent) {
                    let totalPeople = 1 + newValue; // Me + Guests
                    let totalCost = totalPeople * eventPrice;

                    // Format currency (Naira)
                    let formatted = new Intl.NumberFormat('en-NG', {
                        style: 'currency',
                        currency: 'NGN'
                    }).format(totalCost);

                    // Update the Button Text
                    let display = document.getElementById('total_price_display');
                    if (display) {
                        display.innerText = formatted;
                    }
                }
            }
        }
    </script>
</x-app-layout>
