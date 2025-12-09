<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-100">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">

            <!-- ADMIN NAVIGATION TABS -->
            <div class="mb-6 flex space-x-4 border-b border-gray-200">
                <a href="{{ route('admin.events.index') }}"
                    class="px-4 py-2 font-medium text-gray-500 hover:text-gray-700">Manage Events</a>
                <a href="{{ route('admin.categories.index') }}"
                    class="px-4 py-2 font-medium text-gray-500 hover:text-gray-700">Categories</a>
                <a href="{{ route('admin.users.index') }}"
                    class="border-b-2 border-indigo-500 px-4 py-2 font-medium text-indigo-600">Users</a>
            </div>

            <div class="overflow-hidden bg-white p-6 shadow-sm sm:rounded-lg">
                <h3 class="mb-4 text-lg font-bold">All Users</h3>

                @if (session('success'))
                    <div class="mb-4 rounded border border-green-400 bg-green-100 px-4 py-3 text-green-700">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="mb-4 rounded border border-red-400 bg-red-100 px-4 py-3 text-red-700">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="overflow-x-auto">
                    <table class="min-w-full border bg-white">
                        <thead>
                            <tr class="bg-gray-100 text-left">
                                <th class="border-b px-4 py-3">ID</th>
                                <th class="border-b px-4 py-3">Name</th>
                                <th class="border-b px-4 py-3">Email</th>
                                <th class="border-b px-4 py-3">Role</th>
                                <th class="border-b px-4 py-3">Joined</th>
                                <th class="border-b px-4 py-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- ✅ CORRECT: Loop through USERS here --}}
                            @foreach ($users as $user)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="px-4 py-3">{{ $user->id }}</td>
                                    <td class="px-4 py-3 font-medium">{{ $user->name }}</td>
                                    <td class="px-4 py-3 text-gray-500">{{ $user->email }}</td>
                                    <td class="px-4 py-3">
                                        @if ($user->is_admin)
                                            <span
                                                class="rounded bg-purple-100 px-2 py-1 text-xs font-bold text-purple-800">Admin</span>
                                        @else
                                            <span
                                                class="rounded bg-gray-100 px-2 py-1 text-xs text-gray-800">User</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 text-sm text-gray-500">
                                        {{ $user->created_at->format('M d, Y') }}</td>
                                    <td class="px-4 py-3">
                                        {{-- Prevent deleting yourself or other admins --}}
                                        @if (!$user->is_admin)
                                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST"
                                                onsubmit="return confirm('Are you sure you want to delete this user? All their events will be deleted too.');">
                                                @csrf
                                                @method('DELETE')
                                                <button
                                                    class="text-sm font-bold text-red-600 hover:text-red-900">Delete</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
