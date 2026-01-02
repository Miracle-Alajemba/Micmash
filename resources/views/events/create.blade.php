<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-white">
            {{ __('Host an Event') }}
        </h2>
    </x-slot>

    <div class="min-h-screen bg-gray-50/50 py-12">
        <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">

            <!-- Title Section -->
            <div class="mb-10 text-center">
                <h1 class="text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl">Create a New Experience
                </h1>
                <p class="mt-3 text-lg text-gray-500">Share your event with the community. Fill in the details below.
                </p>
            </div>

            <!-- Validation Errors -->
            @if ($errors->any())
                <div class="mb-8 rounded-xl border border-red-200 bg-white p-4 shadow-sm">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-red-800">There were errors with your submission</h3>
                            <ul class="mt-1 list-disc pl-5 text-sm text-red-700">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">

                    <!-- LEFT COLUMN: Main Info -->
                    <div class="space-y-8 lg:col-span-2">

                        <!-- Card: Basic Details -->
                        <div class="rounded-2xl border border-gray-100 bg-white p-6 shadow-sm sm:p-8">
                            <div class="mb-6 flex items-center gap-3 border-b border-gray-100 pb-4">
                                <div
                                    class="flex h-10 w-10 items-center justify-center rounded-full bg-indigo-50 text-indigo-600">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <h3 class="text-lg font-bold text-gray-900">Event Details</h3>
                            </div>

                            <div class="space-y-6">
                                <!-- Title -->
                                <div>
                                    <label class="mb-2 block text-sm font-bold text-gray-700">Event Title</label>
                                    <input type="text" name="title" value="{{ old('title') }}"
                                        class="block w-full rounded-xl border-gray-300 bg-gray-50 p-3 shadow-sm transition-all focus:border-indigo-500 focus:bg-white focus:ring-indigo-500"
                                        placeholder="e.g. Annual Tech Conference 2025" required>
                                </div>

                                <!-- Description -->
                                <div>
                                    <label class="mb-2 block text-sm font-bold text-gray-700">Description</label>
                                    <textarea name="description" rows="6"
                                        class="block w-full rounded-xl border-gray-300 bg-gray-50 p-3 shadow-sm transition-all focus:border-indigo-500 focus:bg-white focus:ring-indigo-500"
                                        placeholder="Tell people what makes this event special..." required>{{ old('description') }}</textarea>
                                </div>

                                <!-- Category & URL -->
                                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                                    <div>
                                        <label class="mb-2 block text-sm font-bold text-gray-700">Category</label>
                                        <select name="category_id"
                                            class="block w-full rounded-xl border-gray-300 bg-gray-50 p-3 shadow-sm transition-all focus:border-indigo-500 focus:bg-white focus:ring-indigo-500"
                                            required>
                                            <option value="">Select Category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <label class="mb-2 block text-sm font-bold text-gray-700">External Link</label>
                                        <input type="url" name="url" value="{{ old('url') }}"
                                            class="block w-full rounded-xl border-gray-300 bg-gray-50 p-3 shadow-sm transition-all focus:border-indigo-500 focus:bg-white focus:ring-indigo-500"
                                            placeholder="https://website.com" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Card: Logistics -->
                        <div class="rounded-2xl border border-gray-100 bg-white p-6 shadow-sm sm:p-8">
                            <div class="mb-6 flex items-center gap-3 border-b border-gray-100 pb-4">
                                <div
                                    class="flex h-10 w-10 items-center justify-center rounded-full bg-indigo-50 text-indigo-600">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </div>
                                <h3 class="text-lg font-bold text-gray-900">Time & Location</h3>
                            </div>

                            <div class="space-y-6">
                                <!-- Location -->
                                <div>
                                    <label class="mb-2 block text-sm font-bold text-gray-700">Venue / Location</label>
                                    <input type="text" name="location" value="{{ old('location') }}"
                                        class="block w-full rounded-xl border-gray-300 bg-gray-50 p-3 shadow-sm transition-all focus:border-indigo-500 focus:bg-white focus:ring-indigo-500"
                                        placeholder="e.g. Grand Hall, Lagos" required>
                                </div>

                                <!-- Date & Time -->
                                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                                    <div>
                                        <label class="mb-2 block text-sm font-bold text-gray-700">Date</label>
                                        <div class="relative">
                                            <div
                                                class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                                <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                            </div>
                                            <input type="date" name="date" value="{{ old('date') }}"
                                                class="block w-full rounded-xl border-gray-300 bg-gray-50 p-3 pl-10 shadow-sm transition-all focus:border-indigo-500 focus:bg-white focus:ring-indigo-500"
                                                required>
                                        </div>
                                    </div>
                                    <div>
                                        <label class="mb-2 block text-sm font-bold text-gray-700">Time</label>
                                        <div class="relative">
                                            <div
                                                class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                                <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                            </div>
                                            <input type="time" name="time" value="{{ old('time') }}"
                                                class="block w-full rounded-xl border-gray-300 bg-gray-50 p-3 pl-10 shadow-sm transition-all focus:border-indigo-500 focus:bg-white focus:ring-indigo-500"
                                                required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Card: Speakers (Alpine) -->
                        <div class="rounded-2xl border border-gray-100 bg-white p-6 shadow-sm sm:p-8"
                            x-data="{ speakers: [{ id: 1 }] }">
                            <div class="mb-6 flex items-center justify-between border-b border-gray-100 pb-4">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="flex h-10 w-10 items-center justify-center rounded-full bg-indigo-50 text-indigo-600">
                                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                    </div>
                                    <h3 class="text-lg font-bold text-gray-900">Speakers</h3>
                                </div>
                                <button type="button" @click="speakers.push({id: Date.now()})"
                                    class="text-sm font-bold text-indigo-600 hover:text-indigo-800 hover:underline">
                                    + Add Person
                                </button>
                            </div>

                            <div class="space-y-4">
                                <template x-for="(speaker, index) in speakers" :key="speaker.id">
                                    <div
                                        class="relative rounded-xl border border-gray-200 bg-gray-50 p-4 transition hover:border-indigo-200 hover:shadow-sm">

                                        <!-- Remove Icon -->
                                        <button type="button"
                                            @click="speakers = speakers.filter(s => s.id !== speaker.id)"
                                            class="absolute right-2 top-2 text-gray-400 hover:text-red-500">
                                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>

                                        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                                            <!-- Name -->
                                            <div>
                                                <label class="mb-1 block text-xs font-bold text-gray-500">Speaker
                                                    Name</label>
                                                <input type="text" :name="'speakers[' + index + '][name]'"
                                                    class="w-full rounded-lg border-gray-300 text-sm focus:border-indigo-500 focus:ring-indigo-500"
                                                    placeholder="Full Name">
                                            </div>
                                            <!-- Role -->
                                            <div class="md:pr-6">
                                                <label class="mb-1 block text-xs font-bold text-gray-500">Role /
                                                    Title</label>
                                                <input type="text" :name="'speakers[' + index + '][role]'"
                                                    class="w-full rounded-lg border-gray-300 text-sm focus:border-indigo-500 focus:ring-indigo-500"
                                                    placeholder="e.g. Host">
                                            </div>
                                            <!-- Photo -->
                                            <div class="md:col-span-2">
                                                <label class="mb-1 block text-xs font-bold text-gray-500">Photo</label>
                                                <input type="file" :name="'speakers[' + index + '][image]'"
                                                    class="w-full rounded-lg border border-gray-300 text-xs text-gray-500 file:mr-4 file:rounded-full file:border-0 file:bg-white file:px-3 file:py-1 file:text-xs file:font-semibold file:text-indigo-700 hover:file:bg-gray-100">
                                            </div>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </div>

                    </div>

                    <!-- RIGHT COLUMN: Media & Price -->
                    <div class="space-y-8 lg:col-span-1">

                        <!-- Upload Image -->
                        <div class="rounded-2xl border border-gray-100 bg-white p-6 shadow-sm sm:p-8">
                            <label class="mb-4 block text-lg font-bold text-gray-900">Cover Image</label>

                            <div
                                class="relative flex flex-col items-center justify-center rounded-xl border-2 border-dashed border-gray-300 bg-gray-50 p-6 text-center transition hover:border-indigo-500 hover:bg-indigo-50/30">
                                <div class="mb-3 rounded-full bg-white p-3 shadow-sm">
                                    <svg class="h-8 w-8 text-indigo-500" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <p class="mb-1 text-sm font-semibold text-gray-900">Click to upload</p>
                                <p class="text-xs text-gray-500">SVG, PNG, JPG (Max 2MB)</p>
                                <input type="file" name="image"
                                    class="absolute inset-0 h-full w-full cursor-pointer opacity-0">
                            </div>
                        </div>

                        <!-- Price -->
                        <div class="rounded-2xl border border-gray-100 bg-white p-6 shadow-sm sm:p-8">
                            <label class="mb-4 block text-lg font-bold text-gray-900">Ticket Price</label>

                            <div class="relative">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                    <span class="text-gray-500 sm:text-lg">₦</span>
                                </div>
                                <input type="number" name="price" value="0" min="0" step="0.01"
                                    class="block w-full rounded-xl border-gray-300 bg-gray-50 p-3 pl-8 text-lg font-bold text-gray-900 shadow-sm transition-all focus:border-indigo-500 focus:bg-white focus:ring-indigo-500"
                                    placeholder="0.00">
                            </div>
                            <p class="mt-2 text-xs text-gray-500">Leave as <strong>0</strong> for free events.</p>
                        </div>

                        <!-- Actions -->
                        <div class="sticky top-6">
                            <button type="submit"
                                class="w-full transform rounded-xl bg-indigo-600 px-6 py-4 text-lg font-bold text-white shadow-lg transition hover:-translate-y-1 hover:bg-indigo-700 hover:shadow-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                Publish Event
                            </button>
                            <a href="{{ route('events.index') }}"
                                class="mt-4 block w-full rounded-xl border border-gray-200 bg-white py-3 text-center font-bold text-gray-600 transition hover:bg-gray-50">
                                Cancel
                            </a>
                        </div>

                    </div>

                </div>
            </form>

        </div>
    </div>
</x-app-layout>
