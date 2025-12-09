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
                    class="border-b-2 border-indigo-500 px-4 py-2 font-medium text-indigo-600">Categories</a>
                <a href="{{ route('admin.users.index') }}"
                    class="px-4 py-2 font-medium text-gray-500 hover:text-gray-700">Users</a>
            </div>

            <div class="grid grid-cols-1 gap-6 md:grid-cols-3">

                <!-- LEFT: Create Category Form -->
                <div class="h-fit rounded-lg bg-white p-6 shadow-sm">
                    <h3 class="mb-4 text-lg font-bold">Add Category</h3>
                    <form action="{{ route('admin.categories.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label class="mb-2 block text-sm font-bold text-gray-700">Category Name</label>
                            <input type="text" name="name"
                                class="w-full rounded border px-3 py-2 text-gray-700 focus:border-indigo-500 focus:outline-none"
                                required>
                            @error('name')
                                <span class="text-xs text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <button
                            class="w-full rounded bg-indigo-600 px-4 py-2 text-white hover:bg-indigo-700">Create</button>
                    </form>
                </div>

                <!-- RIGHT: List of Categories -->
                <div class="rounded-lg bg-white p-6 shadow-sm md:col-span-2">
                    <h3 class="mb-4 text-lg font-bold">Existing Categories</h3>

                    @if (session('success'))
                        <div class="mb-4 rounded border border-green-400 bg-green-100 px-4 py-3 text-green-700">
                            {{ session('success') }}
                        </div>
                    @endif

                    <ul class="divide-y divide-gray-200">
                        @foreach ($categories as $category)
                            <li class="flex items-center justify-between py-3">
                                <span class="font-medium text-gray-800">{{ $category->name }}</span>
                                <form action="{{ route('admin.categories.destroy', $category) }}" method="POST"
                                    onsubmit="return confirm('Delete this category?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-sm text-red-500 hover:text-red-700">Delete</button>
                                </form>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
