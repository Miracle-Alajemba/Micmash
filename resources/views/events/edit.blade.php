<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Edit Event') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-3xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white p-8 shadow-sm sm:rounded-lg">

                <div class="mb-6 flex items-center justify-between">
                    <h1 class="text-2xl font-bold text-gray-800">Edit Details</h1>
                    <a href="{{ route('events.show', $event) }}" class="text-indigo-600 hover:underline">Cancel</a>
                </div>

                <!-- Validation Errors -->
                @if ($errors->any())
                    <div class="mb-4 rounded-md bg-red-50 p-4 text-red-600">
                        <ul class="list-inside list-disc">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('events.update', $event) }}" method="POST" enctype="multipart/form-data"
                    class="space-y-6">
                    @csrf
                    @method('PUT') <!-- Important for Updates -->

                    <!-- Title -->
                    <div>
                        <label class="block font-medium text-gray-700">Event Title</label>
                        <input type="text" name="title" value="{{ old('title', $event->title) }}"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            required>
                    </div>

                    <!-- Category -->
                    <div>
                        <label class="block font-medium text-gray-700">Category</label>
                        <select name="category_id"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            required>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id', $event->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Description -->
                    <div>
                        <label class="block font-medium text-gray-700">Description</label>
                        <textarea name="description" rows="4"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>{{ old('description', $event->description) }}</textarea>
                    </div>

                    <!-- Location -->
                    <div>
                        <label class="block font-medium text-gray-700">Location</label>
                        <input type="text" name="location" value="{{ old('location', $event->location) }}"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            required>
                    </div>

                    <!-- Date & Time -->
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block font-medium text-gray-700">Date</label>
                            <input type="date" name="date" value="{{ old('date', $event->date) }}"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                required>
                        </div>
                        <div>
                            <label class="block font-medium text-gray-700">Time</label>
                            {{-- We slice the time string to fit HTML time input format (HH:MM) --}}
                            <input type="time" name="time"
                                value="{{ old('time', \Illuminate\Support\Str::substr($event->time, 0, 5)) }}"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                required>
                        </div>
                    </div>

                    <!-- Current Image Preview -->
                    @if ($event->image)
                        <div class="mb-2">
                            <label class="mb-1 block font-medium text-gray-700">Current Event Image</label>
                            <img src="{{ asset('storage/eventimages/' . $event->image) }}"
                                class="h-32 w-auto rounded-md border">
                        </div>
                    @endif
                    <div>
                        <label class="block font-medium text-gray-700">Ticket Price (₦)</label>
                        <div class="relative mt-1 rounded-md shadow-sm">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                <span class="text-gray-500 sm:text-sm">₦</span>
                            </div>
                            <input type="number" name="price" value="{{ old('price', $event->price) }}"
                                min="0" step="0.01"
                                class="block w-full rounded-md border-gray-300 pl-7 focus:border-indigo-500 focus:ring-indigo-500"
                                placeholder="0.00">
                        </div>
                        <p class="mt-1 text-xs text-gray-500">Set to 0 to make it free.</p>
                    </div>
                    <!-- Image Upload -->
                    <div>
                        <label class="block font-medium text-gray-700">Update Image (Optional)</label>
                        <input type="file" name="image"
                            class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:rounded-full file:border-0 file:bg-indigo-50 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-indigo-700 hover:file:bg-indigo-100">
                    </div>

                    <!-- Submit -->
                    <div class="flex justify-end space-x-4">
                        <a href="{{ route('events.show', $event) }}"
                            class="rounded-md bg-gray-200 px-4 py-2 text-gray-700 hover:bg-gray-300">Cancel</a>
                        <button type="submit"
                            class="rounded-md bg-indigo-600 px-6 py-2 text-white shadow transition hover:bg-indigo-700">
                            Update Event
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
