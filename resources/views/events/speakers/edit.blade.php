<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      Edit Speaker: {{ $speaker->name }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white shadow-sm sm:rounded-lg p-6">

        <form action="{{ route('events.speakers.update', $speaker) }}" method="POST" enctype="multipart/form-data"
          class="space-y-4">
          @csrf
          @method('PUT') <!-- Important for updates -->

          <div>
            <label class="block font-medium text-gray-700">Speaker Name</label>
            <input type="text" name="name" value="{{ old('name', $speaker->name) }}"
              class="w-full border-gray-300 rounded-md shadow-sm" required>
          </div>

          <div>
            <label class="block font-medium text-gray-700">Role / Title</label>
            <input type="text" name="role" value="{{ old('role', $speaker->role) }}"
              class="w-full border-gray-300 rounded-md shadow-sm">
          </div>

          @if($speaker->image)
            <div class="mb-2">
              <p class="text-sm text-gray-500 mb-1">Current Photo:</p>
              <img src="{{ asset('storage/speakers/' . $speaker->image) }}"
                class="w-16 h-16 rounded-full object-cover border">
            </div>
          @endif

          <div>
            <label class="block font-medium text-gray-700">Update Photo (Optional)</label>
            <input type="file" name="image" class="w-full mt-1">
          </div>

          <div class="flex justify-between items-center mt-4">
            <a href="{{ route('events.show', $event) }}" class="text-gray-600 hover:underline">Cancel</a>
            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded shadow hover:bg-indigo-700">
              Update Speaker
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</x-app-layout>
