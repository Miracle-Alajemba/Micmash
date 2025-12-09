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
                                <th class="px-4 py-3 text-left">Url</th>
                                <th class="px-4 py-3 text-left">Date</th>
                                <th class="px-4 py-3 text-left">Status</th>
                                <th class="px-4 py-3 text-left">Actions</th>
                                <th class="px-4 py-3 text-left">Attending</th>
                                <th class="px-4 py-3 text-left">likes</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($events as $event)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="px-4 py-3 font-medium">
                                        <a href="{{ route('events.show', $event) }}"
                                            class="text-indigo-600 hover:underline">
                                            {{ $event->title }}
                                        </a>
                                    </td>
                                    <td class="px-4 py-3 text-sm text-gray-600">{{ $event->user->name }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-600">{{ $event->url }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-600">{{ $event->date }}</td>
                                    <td class="px-4 py-3">
                                        <span
                                            class="{{ $event->status === 'approved'
                                                ? 'bg-green-100 text-green-800'
                                                : ($event->status === 'rejected'
                                                    ? 'bg-red-100 text-red-800'
                                                    : 'bg-yellow-100 text-yellow-800') }} rounded px-2 py-1 text-xs font-bold">
                                            {{ ucfirst($event->status) }}
                                        </span>
                                    </td>
                                    <td class="flex space-x-2 px-4 py-3">
                                        @if ($event->status !== 'approved')
                                            <form action="{{ route('admin.events.approve', $event) }}" method="POST">
                                                @csrf
                                                <button
                                                    class="text-1xl rounded bg-green-600 px-3 py-1 text-white transition hover:bg-green-700">
                                                    Approve
                                                </button>
                                            </form>
                                        @endif

                                        @if ($event->status !== 'rejected')
                                            <form action="{{ route('admin.events.reject', $event) }}" method="POST">
                                                @csrf
                                                <button
                                                    class="text-1xl rounded bg-red-600 px-3 py-1 text-white transition hover:bg-red-700">
                                                    Reject
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                    <td class="px-1 py-3 text-sm text-gray-600">{{ $event->rsvps->count() }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-600">{{ $event->likes->count() }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-4 text-center text-gray-500">No events found.</td>
                                </tr>
                            @endforelse

                        </tbody>

                    </table>
                </div>
                <div class="mt-4">
                    {{ $events->links() }}
                </div </div>
            </div>
        </div>
</x-app-layout>
