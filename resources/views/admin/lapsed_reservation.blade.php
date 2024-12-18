<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-200">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="py-2 px-4  border-x border-y">Reservation Name</th>
                                <th class="py-2 px-4  border-x border-y">Customer Name</th>
                                <th class="py-2 px-4  border-x border-y">Customer Email</th>
                                <th class="py-2 px-4  border-x border-y">Reservation Date</th>
                                <th class="py-2 px-4  border-x border-y">Reservation Time</th>
                                <th class="py-2 px-4  border-x border-y">Status</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reservations as $reservation)
                                @php
                                    // Combine reservation date and time
                                    $reservationDateTime = Carbon\Carbon::createFromFormat('Y-m-d h:i A', $reservation->reservation_date . ' ' . $reservation->reservation_time, 'UTC')->setTimezone(config('app.timezone'));
                                    $currentDateTime = Carbon\Carbon::now()->setTimezone(config('app.timezone'));
                                @endphp
                                <tr class="hover:bg-gray-50">
                                    <td class="py-2 px-4 border-b border-y">{{ $reservation->event_name }}</td>
                                    <td class="py-2 px-4 border-b border-y">{{ $reservation->user_name }}</td>
                                    <td class="py-2 px-4 border-b border-y">{{ $reservation->user_email }}</td>
                                    <td class="py-2 px-4 border-b border-y">{{ $reservation->reservation_date }}</td>
                                    <td class="py-2 px-4 border-b border-y">{{ $reservation->reservation_time }}</td>
                                    {{-- <td class="py-2 px-4 border-b">{{ $reservation->number_of_people }}</td> --}}
                                    <td class="py-2 px-4 border-b border-y">
                                        @if ($reservation->status == 'pending')
                                            <span class="inline-block px-2 py-1 text-xs font-bold text-yellow-800 bg-yellow-200 rounded-full">{{ $reservation->status }}</span>
                                        @elseif ($reservation->status == 'approved')
                                            <span class="inline-block px-2 py-1 text-xs font-bold text-green-800 bg-green-200 rounded-full">{{ $reservation->status }}</span>
                                        @else
                                            <span class="inline-block px-2 py-1 text-xs font-bold text-red-800 bg-red-200 rounded-full">{{ $reservation->status }}</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
