<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Guest List: {{ $event->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white p-6 shadow-sm sm:rounded-lg">

                <div class="mb-4 flex justify-between">
                    <h3 class="text-lg font-bold">Total Headcount: {{ $event->total_attendees }}</h3>
                    <button onclick="window.print()" class="rounded bg-gray-800 px-4 py-2 text-sm text-white">Print
                        List</button>
                </div>

                <table class="min-w-full border">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 text-left">User Name</th>
                            <th class="px-4 py-2 text-left">Email</th>
                            <th class="px-4 py-2 text-left">Plus Ones</th>
                            <th class="px-4 py-2 text-left">Ticket Status</th>
                            <th class="px-4 py-2 text-left">Ticket ID (Ref)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($attendees as $rsvp)
                            <tr class="border-b">
                                <td class="px-4 py-2 font-bold">{{ $rsvp->user->name }}</td>
                                <td class="px-4 py-2 text-sm text-gray-600">{{ $rsvp->user->email }}</td>
                                <td class="px-4 py-2 text-center">+ {{ $rsvp->guests_count }}</td>
                                <td class="px-4 py-2">
                                    @if ($event->price == 0)
                                        <span class="text-xs font-bold text-blue-600">FREE</span>
                                    @elseif($rsvp->payment && $rsvp->payment->status == 'success')
                                        <span class="text-xs font-bold text-green-600">PAID</span>
                                    @else
                                        <span class="text-xs font-bold text-red-600">NOT PAID</span>
                                    @endif
                                </td>
                                <td class="px-4 py-2 font-mono text-sm">
                                    {{ $rsvp->payment->reference ?? '---' }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
