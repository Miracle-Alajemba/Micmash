<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-100">
            {{ __('Admin: Manage Events') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white p-6 shadow-sm sm:rounded-lg">

                <!-- ADMIN NAVIGATION TABS -->
                <div class="mb-6 flex space-x-4 border-b border-gray-200">
                    <a href="{{ route('admin.events.index') }}"
                        class="border-b-2 border-indigo-500 px-4 py-2 font-medium text-indigo-600">Manage Events</a>
                    <a href="{{ route('admin.categories.index') }}"
                        class="px-4 py-2 font-medium text-gray-500 hover:text-gray-700">Categories</a>
                    <a href="{{ route('admin.users.index') }}"
                        class="px-4 py-2 font-medium text-gray-500 hover:text-gray-700">Users</a>
                </div>

                <h3 class="mb-4 font-inter text-lg font-bold">Event Moderation</h3>

                <div class="overflow-x-auto">
                    <table class="min-w-full border border-gray-200 bg-white">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-3 text-left">Title</th>
                                <th class="px-4 py-3 text-left">Organizer</th>
                                <th class="px-4 py-3 text-left">Status</th>
                                <th class="px-4 py-3 text-left">Guest List</th> {{-- Added Header --}}
                                <th class="px-4 py-3 text-left">Actions</th>
                                <th class="px-4 py-3 text-left">RSVPs</th>
                                <th class="px-4 py-3 text-left">Likes</th>
                                <th class="px-4 py-3 text-left">Total Heads</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($events as $event)
                                <tr class="border-b hover:bg-gray-50">
                                    {{-- Title & Link --}}
                                    <td class="px-4 py-3 font-medium">
                                        <a href="{{ route('events.show', $event) }}" target="_blank"
                                            class="text-indigo-600 hover:underline">
                                            {{ $event->title }}
                                        </a>
                                        <div class="text-xs text-gray-500">{{ $event->date }}</div>
                                    </td>

                                    {{-- Organizer --}}
                                    <td class="px-4 py-3 text-sm text-gray-600">{{ $event->user->name }}</td>

                                    {{-- Status Badge --}}
                                    <td class="px-4 py-3">
                                        <span
                                            class="{{ $event->status === 'approved' ? 'bg-green-100 text-green-800' : ($event->status === 'rejected' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }} rounded px-2 py-1 text-xs font-bold">
                                            {{ ucfirst($event->status) }}
                                        </span>
                                    </td>

                                    {{-- Guest List Link --}}
                                    <td class="px-4 py-3">
                                        <a href="{{ route('admin.events.attendees', $event) }}"
                                            class="text-sm font-medium text-indigo-600 hover:text-indigo-900 hover:underline">
                                            View List
                                        </a>
                                    </td>

                                    {{-- Actions (Approve/Reject) --}}
                                    <td class="px-4 py-3">
                                        <div class="flex space-x-2">
                                            @if ($event->status !== 'approved')
                                                <form action="{{ route('admin.events.approve', $event) }}"
                                                    method="POST">
                                                    @csrf
                                                    <button
                                                        class="rounded bg-green-600 px-3 py-1 text-xs font-bold text-white transition hover:bg-green-700">
                                                        Approve
                                                    </button>
                                                </form>
                                            @endif

                                            @if ($event->status !== 'rejected')
                                                <form action="{{ route('admin.events.reject', $event) }}"
                                                    method="POST">
                                                    @csrf
                                                    <button
                                                        class="rounded bg-red-600 px-3 py-1 text-xs font-bold text-white transition hover:bg-red-700">
                                                        Reject
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>

                                    {{-- Stats --}}
                                    <td class="px-4 py-3 text-sm text-gray-600">{{ $event->rsvps->count() }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-600">{{ $event->likes->count() }}</td>
                                    <td class="px-4 py-3 text-sm font-bold text-gray-800">{{ $event->total_attendees }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="py-4 text-center text-gray-500">No events found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $events->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
