<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-2xl font-bold tracking-tight text-gray-900">
                {{ __('My Tickets') }}
            </h2>
            <span class="rounded-full bg-indigo-50 px-3 py-1 text-xs font-medium text-indigo-600">
                {{ $tickets->count() }} Total
            </span>
        </div>
    </x-slot>

    <div class="min-h-screen bg-gray-50 py-12">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">

                @forelse($tickets as $ticket)
                    <!-- TICKET CARD -->
                    <div
                        class="group relative flex flex-col overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-gray-200/50 transition-all duration-300 hover:-translate-y-1 hover:shadow-lg">

                        <!-- 1. TOP: IMAGE & STATUS -->
                        <div class="relative h-48 w-full overflow-hidden bg-gray-100">
                            @if ($ticket->event->image)
                                <img src="{{ asset('storage/eventimages/' . $ticket->event->image) }}"
                                    class="h-full w-full object-cover transition duration-700 group-hover:scale-105">
                            @else
                                <div class="flex h-full items-center justify-center bg-gray-100 text-gray-300">
                                    <svg class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            @endif

                            <!-- Status Badge (Floating) -->
                            <div class="absolute right-3 top-3">
                                @if ($ticket->event->price > 0)
                                    <span
                                        class="inline-flex items-center rounded-lg bg-white/90 px-2.5 py-1 text-xs font-bold text-gray-900 shadow-sm backdrop-blur-md">
                                        PAID
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center rounded-lg bg-white/90 px-2.5 py-1 text-xs font-bold text-indigo-600 shadow-sm backdrop-blur-md">
                                        FREE
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- 2. CONTENT -->
                        <div class="flex flex-1 flex-col p-5">

                            <!-- Date & Title -->
                            <div class="mb-4">
                                <p class="mb-1 text-xs font-bold uppercase tracking-wider text-indigo-600">
                                    {{ \Carbon\Carbon::parse($ticket->event->date)->format('M d, Y') }} •
                                    {{ \Carbon\Carbon::parse($ticket->event->time)->format('g:i A') }}
                                </p>
                                <h3
                                    class="line-clamp-1 text-lg font-bold text-gray-900 transition-colors group-hover:text-indigo-600">
                                    <a href="{{ route('events.show', $ticket->event) }}">
                                        {{ $ticket->event->title }}
                                    </a>
                                </h3>
                                <p class="mt-1 line-clamp-1 text-sm text-gray-500">
                                    {{ $ticket->event->location }}
                                </p>
                            </div>

                            <!-- 3. FOOTER: TICKET INFO -->
                            <div class="mt-auto rounded-xl bg-gray-50 p-3 ring-1 ring-gray-100">
                                <div class="flex items-center justify-between">

                                    <!-- Admit Count -->
                                    <div>
                                        <p class="text-[10px] font-medium uppercase text-gray-400">Guests</p>
                                        <div class="flex items-center space-x-1">
                                            <svg class="h-3 w-3 text-gray-600" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                            <p class="text-sm font-bold text-gray-900">1 + {{ $ticket->guests_count }}
                                            </p>
                                        </div>
                                    </div>

                                    <!-- Vertical Line -->
                                    <div class="h-8 w-px bg-gray-200"></div>

                                    <div class="text-right">
                                        <p class="text-[10px] font-medium uppercase text-gray-400">ID</p>

                                        @if ($ticket->payment)
                                            {{-- CASE 1: Payment Found --}}
                                            <p class="font-mono text-sm font-bold tracking-wide text-indigo-600">
                                                #{{ strtoupper(substr($ticket->payment->reference, -6)) }}
                                            </p>
                                            {{-- Optional: Show status if not success --}}
                                            @if (strtolower($ticket->payment->status) !== 'success')
                                                <p class="text-[10px] text-red-500">({{ $ticket->payment->status }})
                                                </p>
                                            @endif
                                        @elseif($ticket->event->price == 0)
                                            {{-- CASE 2: Free Event --}}
                                            <p class="text-xs font-bold text-gray-400">FREE PASS</p>
                                        @else
                                            {{-- CASE 3: Paid Event but No Record --}}
                                            <p class="text-xs font-bold text-red-500">Not Found</p>
                                        @endif
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                @empty
                    <!-- EMPTY STATE -->
                    <div
                        class="col-span-full flex flex-col items-center justify-center rounded-2xl border-2 border-dashed border-gray-200 bg-white py-12 text-center">
                        <div class="mb-3 rounded-full bg-gray-50 p-3">
                            <svg class="h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                            </svg>
                        </div>
                        <h3 class="text-sm font-medium text-gray-900">No tickets found</h3>
                        <p class="mt-1 text-sm text-gray-500">Get started by joining an event.</p>
                        <div class="mt-6">
                            <a href="{{ route('events.index') }}"
                                class="inline-flex items-center rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                Browse Events
                            </a>
                        </div>
                    </div>
                @endforelse

            </div>
        </div>
    </div>
</x-app-layout>
