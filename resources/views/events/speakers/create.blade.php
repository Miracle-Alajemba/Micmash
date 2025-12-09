<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      Add Speaker to: {{ $event->title }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white shadow-sm sm:rounded-lg p-6">

        <form action="{{ route('events.speakers.store', $event) }}" method="POST" enctype="multipart/form-data"
          class="space-y-4">
          @csrf

          <div>
            <label class="block font-medium text-gray-700">Speaker Name</label>
            <input type="text" name="name" class="w-full border-gray-300 rounded-md shadow-sm" required>
          </div>

          <div>
            <label class="block font-medium text-gray-700">Role / Title (Optional)</label>
            <input type="text" name="role" placeholder="e.g. CEO, Keynote Speaker"
              class="w-full border-gray-300 rounded-md shadow-sm">
          </div>

          <div>
            <label class="block font-medium text-gray-700">Photo</label>
            <input type="file" name="image" class="w-full mt-1">
          </div>

          <div class="flex justify-end">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded shadow hover:bg-blue-700">
              Add Speaker
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</x-app-layout>
