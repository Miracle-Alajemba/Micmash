<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-100">
            {{ __('Host an Event') }}
        </h2>
    </x-slot>

    <div class="min-h-screen bg-gray-50 py-12">
        <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">

            <div class="overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-xl">

                <!-- Form Header -->
                <div class="bg-indigo-600 px-8 py-6 text-white">
                    <h1 class="text-2xl font-bold">Create a New Experience</h1>
                    <p class="mt-1 text-indigo-100">Fill in the details below to publish your event.</p>
                </div>

                <!-- Validation Errors -->
                @if ($errors->any())
                    <div class="mx-8 mt-6 rounded-r-md border-l-4 border-red-500 bg-red-50 p-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-red-400" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-red-800">Please correct the following errors:</h3>
                                <ul class="mt-1 list-inside list-disc text-sm text-red-700">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data"
                    class="space-y-8 p-8">
                    @csrf

                    <!-- SECTION  MAIN DETAILS -->
                    <div>
                        <h3 class="mb-4 flex items-center text-lg font-bold text-gray-900">
                            <span
                                class="mr-2 flex h-8 w-8 items-center justify-center rounded-full bg-indigo-100 text-sm text-indigo-600">1</span>
                            Event Details
                        </h3>

                        <div class="grid grid-cols-1 gap-x-4 gap-y-6">
                            <!-- Title -->
                            <div>
                                <label class="mb-1 block text-sm font-medium text-gray-700">Event Title</label>
                                <input type="text" name="title" value="{{ old('title') }}"
                                    class="w-full rounded-lg border-gray-300 shadow-sm transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500"
                                    placeholder="e.g. Annual Tech Conference 2025" required>
                            </div>

                            <!-- Category & Location -->
                            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                                <div>
                                    <label class="mb-1 block text-sm font-medium text-gray-700">Category</label>
                                    <select name="category_id"
                                        class="w-full cursor-pointer rounded-lg border-gray-300 shadow-sm transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500"
                                        required>
                                        <option value="">Select a Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label class="mb-1 block text-sm font-medium text-gray-700">Location</label>
                                    <input type="text" name="location" value="{{ old('location') }}"
                                        class="w-full rounded-lg border-gray-300 shadow-sm transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500"
                                        placeholder="e.g. Grand Hall, New York" required>
                                </div>
                            </div>

                            <!-- Date & Time -->
                            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                                <div>
                                    <label class="mb-1 block text-sm font-medium text-gray-700">Date</label>
                                    <input type="date" name="date" value="{{ old('date') }}"
                                        class="w-full rounded-lg border-gray-300 shadow-sm transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500"
                                        required>
                                </div>
                                <div>
                                    <label class="mb-1 block text-sm font-medium text-gray-700">Time</label>
                                    <input type="time" name="time" value="{{ old('time') }}"
                                        class="w-full rounded-lg border-gray-300 shadow-sm transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500"
                                        required>
                                </div>
                            </div>
                            <!-- Price Input -->
                            <div>
                                <label class="block font-medium text-gray-700">Ticket Price (₦)</label>
                                <div class="relative mt-1 rounded-md shadow-sm">
                                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                        <span class="text-gray-500 sm:text-sm">₦</span>
                                    </div>
                                    <input type="number" name="price" value="0" min="0" step="0.01"
                                        class="block w-full rounded-md border-gray-300 pl-7 focus:border-indigo-500 focus:ring-indigo-500"
                                        placeholder="0.00 (Leave 0 for Free)">
                                </div>
                                <p class="mt-1 text-xs text-gray-500">Enter 0 if the event is free.</p>
                            </div>
                            <!-- Url -->
                            <div>
                                <label class="mb-1 block text-sm font-medium text-gray-700">Event Url</label>
                                <input type="text" name="url" value="{{ old('url') }}"
                                    class="w-full rounded-lg border-gray-300 shadow-sm transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500"
                                    placeholder="https://acme/jobs/ceo-wanted" required>
                            </div>


                            <!-- Description -->
                            <div>
                                <label class="mb-1 block text-sm font-medium text-gray-700">Description</label>
                                <textarea name="description" rows="5"
                                    class="w-full rounded-lg border-gray-300 shadow-sm transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500"
                                    placeholder="Describe what your event is about..." required>{{ old('description') }}</textarea>
                            </div>


                            <!-- Cover Image -->
                            <div class="rounded-lg border border-dashed border-gray-300 bg-gray-50 p-4 text-center">
                                <label class="mb-2 block text-sm font-medium text-gray-700">Event Cover Image</label>
                                <input type="file" name="image"
                                    class="w-full cursor-pointer text-sm text-gray-500 transition file:mr-4 file:rounded-full file:border-0 file:bg-indigo-100 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-indigo-700 hover:file:bg-indigo-200">
                                <p class="mt-2 text-xs text-gray-500">PNG, JPG, JPEG up to 2MB</p>
                            </div>
                        </div>
                    </div>

                    <hr class="border-gray-200">

                    <!-- SECTION 2: SPEAKERS (Dynamic Alpine.js) -->
                    <div x-data="{ speakers: [{ id: 1 }] }">
                        <div class="mb-4 flex items-center justify-between">
                            <h3 class="flex items-center text-lg font-bold text-gray-900">
                                <span
                                    class="mr-2 flex h-8 w-8 items-center justify-center rounded-full bg-indigo-100 text-sm text-indigo-600">2</span>
                                Speakers & Guests <span class="ml-2 text-sm font-normal text-gray-500">(Optional)</span>
                            </h3>
                            <button type="button" @click="speakers.push({id: Date.now()})"
                                class="flex items-center rounded-full bg-gray-900 px-4 py-2 text-sm text-white shadow transition hover:bg-black">
                                <svg class="mr-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4"></path>
                                </svg>
                                Add Speaker
                            </button>
                        </div>

                        <div class="space-y-4">
                            <template x-for="(speaker, index) in speakers" :key="speaker.id">
                                <div
                                    class="relative rounded-xl border border-indigo-100 bg-indigo-50 p-5 transition hover:shadow-md">

                                    <!-- Remove Button -->
                                    <button type="button"
                                        @click="speakers = speakers.filter(s => s.id !== speaker.id)"
                                        class="absolute right-2 top-2 rounded-full bg-white p-1 text-gray-400 shadow-sm transition hover:text-red-500 hover:shadow"
                                        title="Remove">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12">
                                            </path>
                                        </svg>
                                    </button>

                                    <h4 class="mb-3 text-xs font-bold uppercase tracking-wider text-indigo-500"
                                        x-text="'Speaker ' + (index + 1)"></h4>

                                    <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                                        <!-- Name -->
                                        <div>
                                            <label class="mb-1 block text-xs font-bold text-gray-600">Name</label>
                                            <input type="text" :name="'speakers[' + index + '][name]'"
                                                class="w-full rounded-md border-gray-300 text-sm focus:border-indigo-500 focus:ring-indigo-500"
                                                placeholder="Full Name">
                                        </div>

                                        <!-- Role -->
                                        <div>
                                            <label class="mb-1 block text-xs font-bold text-gray-600">Role / Job
                                                Title</label>
                                            <input type="text" :name="'speakers[' + index + '][role]'"
                                                class="w-full rounded-md border-gray-300 text-sm focus:border-indigo-500 focus:ring-indigo-500"
                                                placeholder="e.g. Guest Speaker">
                                        </div>

                                        <!-- Photo -->
                                        <div>
                                            <label class="mb-1 block text-xs font-bold text-gray-600">Photo</label>
                                            <input type="file" :name="'speakers[' + index + '][image]'"
                                                class="w-full text-xs text-gray-500 file:rounded-full file:border-0 file:bg-white file:px-3 file:py-1 file:text-indigo-600 hover:file:bg-indigo-50">
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>

                    <!-- SUBMIT -->
                    <div class="flex items-center justify-end gap-4 border-t border-gray-200 pt-6">
                        <a href="{{ route('events.index') }}"
                            class="font-medium text-gray-600 hover:text-gray-900">Cancel</a>
                        <button type="submit"
                            class="transform rounded-xl bg-indigo-600 px-8 py-3 text-lg font-bold text-white shadow-lg transition hover:-translate-y-0.5 hover:bg-indigo-700">
                            Publish Event
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
