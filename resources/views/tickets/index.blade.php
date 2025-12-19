<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('My Tickets') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

                @forelse($tickets as $ticket)
                    <div
                        class="flex flex-col overflow-hidden rounded-xl border border-gray-200 bg-white shadow-lg md:flex-row">

                        <!-- Event Image (Left) -->
                        <div class="relative w-full bg-gray-100 md:w-1/3">
                            @if ($ticket->event->image)
                                <img src="{{ asset('storage/eventimages/' . $ticket->event->image) }}"
                                    class="absolute inset-0 h-full w-full object-cover">
                            @else
                                <div class="flex h-full items-center justify-center text-gray-400">No Image</div>
                            @endif
                        </div>

                        <!-- Ticket Details (Right) -->
                        <div class="flex w-full flex-col justify-between p-6 md:w-2/3">
                            <div>
                                <div class="flex items-start justify-between">
                                    <h3 class="text-xl font-bold text-gray-900">{{ $ticket->event->title }}</h3>
                                    @if ($ticket->event->price > 0)
                                        <span
                                            class="rounded bg-green-100 px-2 py-1 text-xs font-bold text-green-800">PAID</span>
                                    @else
                                        <span
                                            class="rounded bg-blue-100 px-2 py-1 text-xs font-bold text-blue-800">FREE</span>
                                    @endif
                                </div>
                                <p class="mt-1 text-sm text-gray-500">
                                    📍 {{ $ticket->event->location }} <br>
                                    📅 {{ \Carbon\Carbon::parse($ticket->event->date)->format('M d, Y') }} at
                                    {{ $ticket->event->time }}
                                </p>

                                <div class="mt-4 rounded-lg border border-gray-200 bg-gray-50 p-3">
                                    <p class="text-xs font-bold uppercase text-gray-500">Admit</p>
                                    <p class="text-lg font-bold text-gray-800">
                                        1 User + {{ $ticket->guests_count }} Guests
                                    </p>
                                </div>
                            </div>

                            <!-- Payment Reference (The Proof) -->
                            <div class="mt-6 border-t pt-4">
                                @if ($ticket->event->price > 0 && $ticket->payment)
                                    <p class="text-xs text-gray-500">TICKET ID (Show this at door)</p>
                                    <p class="font-mono text-xl font-bold tracking-wider text-indigo-600">
                                        #{{ strtoupper($ticket->payment->reference) }}
                                    </p>
                                @elseif($ticket->event->price > 0 && !$ticket->payment)
                                    <p class="text-sm font-bold text-red-500">Payment Record Not Found</p>
                                @else
                                    <p class="text-sm italic text-gray-500">Free Entry Pass</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full rounded-lg bg-white py-12 text-center shadow">
                        <p class="text-gray-500">You haven't joined any events yet.</p>
                        <a href="{{ route('events.index') }}"
                            class="mt-2 inline-block text-indigo-600 hover:underline">Browse Events</a>
                    </div>
                @endforelse

            </div>
        </div>
    </div>
</x-app-layout>
