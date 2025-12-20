<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Guest List: {{ $event->title }}
            </h2>
            <a href="{{ route('admin.events.index') }}" class="text-sm text-gray-500 hover:text-gray-700">&larr; Back</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white p-6 shadow-sm sm:rounded-lg">

                <!-- HEADER & SEARCH -->
                <div class="mb-6 flex flex-col items-center justify-between gap-4 md:flex-row">
                    <div>
                        <h3 class="text-lg font-bold text-gray-900">Total Headcount: {{ $event->total_attendees }}</h3>
                        <p class="text-sm text-gray-500">
                            {{ $attendees->count() }} registered users
                        </p>
                    </div>

                    <!-- Search Form -->
                    <form method="GET" action="{{ route('admin.events.attendees', $event) }}"
                        class="flex w-full md:w-auto">
                        <input type="text" name="search" placeholder="Search name or email..."
                            value="{{ request('search') }}"
                            class="w-full rounded-l-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 md:w-64">
                        <button class="rounded-r-lg bg-indigo-600 px-4 py-2 text-white transition hover:bg-indigo-700">
                            Search
                        </button>
                        @if (request('search'))
                            <a href="{{ route('admin.events.attendees', $event) }}"
                                class="ml-2 flex items-center text-sm text-red-500 hover:text-red-700">Clear</a>
                        @endif
                    </form>
                </div>

                <!-- TABLE -->
                <div class="overflow-x-auto">
                    <table class="min-w-full border-collapse border border-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-bold uppercase text-gray-500">User</th>
                                <th class="px-4 py-3 text-left text-xs font-bold uppercase text-gray-500">Party Size
                                </th>
                                <th class="px-4 py-3 text-left text-xs font-bold uppercase text-gray-500">Status</th>
                                <th class="px-4 py-3 text-left text-xs font-bold uppercase text-gray-500">Ticket ID
                                    (Ref)</th>
                                <th class="px-4 py-3 text-left text-xs font-bold uppercase text-gray-500">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($attendees as $rsvp)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-3">
                                        <p class="font-bold text-gray-900">{{ $rsvp->user->name }}</p>
                                        <p class="text-sm text-gray-500">{{ $rsvp->user->email }}</p>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="flex items-center">
                                            <span class="font-bold text-gray-800">1</span>
                                            @if ($rsvp->guests_count > 0)
                                                <span class="ml-1 text-sm text-gray-500">+ {{ $rsvp->guests_count }}
                                                    guests</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-4 py-3">
                                        @if ($event->price == 0)
                                            <span
                                                class="inline-flex items-center rounded-full bg-blue-100 px-2.5 py-0.5 text-xs font-medium text-blue-800">
                                                FREE
                                            </span>
                                        @elseif($rsvp->payment && strtolower($rsvp->payment->status) == 'success')
                                            <span
                                                class="inline-flex items-center rounded-full bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800">
                                                PAID
                                            </span>
                                        @else
                                            <span
                                                class="inline-flex items-center rounded-full bg-red-100 px-2.5 py-0.5 text-xs font-medium text-red-800">
                                                UNPAID
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3">
                                        @if ($rsvp->payment)
                                            <span class="font-mono text-sm font-bold text-indigo-600">
                                                #{{ strtoupper(substr($rsvp->payment->reference, -6)) }}
                                            </span>
                                            <div class="text-[10px] text-gray-400">{{ $rsvp->payment->reference }}
                                            </div>
                                        @else
                                            <span class="text-sm text-gray-400">---</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3">
                                        {{-- A fake check-in button for UI purposes --}}
                                        <button
                                            onclick="this.innerHTML='✅ Checked In'; this.className='text-green-600 font-bold text-sm cursor-default';"
                                            class="rounded border border-gray-300 px-3 py-1 text-xs font-medium text-gray-700 transition hover:bg-gray-50">
                                            Verify
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-4 py-8 text-center text-gray-500">
                                        No attendees found matching your search.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
