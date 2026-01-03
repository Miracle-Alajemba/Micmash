<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-100">
            Add Speaker to: {{ $event->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-xl sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">

                <form action="{{ route('events.speakers.store', $event) }}" method="POST" enctype="multipart/form-data"
                    class="space-y-4">
                    @csrf

                    <div>
                        <label class="block font-medium text-gray-700">Speaker Name</label>
                        <input type="text" name="name" class="w-full rounded-md border-gray-300 shadow-sm"
                            required>
                    </div>

                    <div>
                        <label class="block font-medium text-gray-700">Role / Title (Optional)</label>
                        <input type="text" name="role" placeholder="e.g. CEO, Keynote Speaker"
                            class="w-full rounded-md border-gray-300 shadow-sm">
                    </div>

                    <div>
                        <label class="block font-medium text-gray-700">Photo</label>
                        <input type="file" name="image" class="mt-1 w-full">
                    </div>

                    <div class="flex justify-end">
                        <button type="submit"
                            class="rounded bg-blue-600 px-4 py-2 text-white shadow hover:bg-blue-700">
                            Add Speaker
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
