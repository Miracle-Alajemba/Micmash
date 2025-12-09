<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Event') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">

                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-2xl font-bold text-gray-800">Edit Details</h1>
                    <a href="{{ route('events.show', $event) }}" class="text-indigo-600 hover:underline">Cancel</a>
                </div>

                <!-- Validation Errors -->
                @if ($errors->any())
                    <div class="mb-4 bg-red-50 text-red-600 p-4 rounded-md">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('events.update', $event) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT') <!-- Important for Updates -->

                    <!-- Title -->
                    <div>
                        <label class="block font-medium text-gray-700">Event Title</label>
                        <input type="text" name="title" value="{{ old('title', $event->title) }}"
                               class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                    </div>

                    <!-- Category -->
                    <div>
                        <label class="block font-medium text-gray-700">Category</label>
                        <select name="category_id" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id', $event->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }} a
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Description -->
                    <div>
                        <label class="block font-medium text-gray-700">Description</label>
                        <textarea name="description" rows="4"
                                  class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>{{ old('description', $event->description) }}</textarea>
                    </div>

                    <!-- Location -->
                    <div>
                        <label class="block font-medium text-gray-700">Location</label>
                        <input type="text" name="location" value="{{ old('location', $event->location) }}"
                               class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                    </div>

                    <!-- Date & Time -->
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block font-medium text-gray-700">Date</label>
                            <input type="date" name="date" value="{{ old('date', $event->date) }}"
                                   class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                        </div>
                        <div>
                            <label class="block font-medium text-gray-700">Time</label>
                            {{-- We slice the time string to fit HTML time input format (HH:MM) --}}
                            <input type="time" name="time" value="{{ old('time', \Illuminate\Support\Str::substr($event->time, 0, 5)) }}"
                                   class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                        </div>
                    </div>

                    <!-- Current Image Preview -->
                    @if($event->image)
                        <div class="mb-2">
                            <label class="block font-medium text-gray-700 mb-1">Current Image</label>
                            <img src="{{ asset('storage/events/' . $event->image) }}" class="h-32 w-auto rounded-md border">
                        </div>
                    @endif

                    <!-- Image Upload -->
                    <div>
                        <label class="block font-medium text-gray-700">Update Image (Optional)</label>
                        <input type="file" name="image" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                    </div>

                    <!-- Submit -->
                    <div class="flex justify-end space-x-4">
                        <a href="{{ route('events.show', $event) }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300">Cancel</a>
                        <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-md hover:bg-indigo-700 transition shadow">
                            Update Event
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
