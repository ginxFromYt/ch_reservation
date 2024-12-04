<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-200">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="py-2 px-4 border-b">Reservation Name</th>
                                <th class="py-2 px-4 border-b">Customer Name</th>
                                <th class="py-2 px-4 border-b">Customer Email</th>
                                <th class="py-2 px-4 border-b">Reservation Date</th>
                                <th class="py-2 px-4 border-b">Reservation Time</th>
                                <th class="py-2 px-4 border-b">Number of People</th>
                                <th class="py-2 px-4 border-b">Status</th>
                                <th class="py-2 px-4 border-b">Action</th>
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
                                    <td class="py-2 px-4 border-b">{{ $reservation->event_name }}</td>
                                    <td class="py-2 px-4 border-b">{{ $reservation->user_name }}</td>
                                    <td class="py-2 px-4 border-b">{{ $reservation->user_email }}</td>
                                    <td class="py-2 px-4 border-b">{{ $reservation->reservation_date }}</td>
                                    <td class="py-2 px-4 border-b">{{ $reservation->reservation_time }}</td>
                                    <td class="py-2 px-4 border-b">{{ $reservation->number_of_people }}</td>
                                    <td class="py-2 px-4 border-b">
                                        @if ($reservation->status == 'pending')
                                            <span class="inline-block px-2 py-1 text-xs font-bold text-yellow-800 bg-yellow-200 rounded-full">{{ $reservation->status }}</span>
                                        @elseif ($reservation->status == 'approved')
                                            <span class="inline-block px-2 py-1 text-xs font-bold text-green-800 bg-green-200 rounded-full">{{ $reservation->status }}</span>
                                        @else
                                            <span class="inline-block px-2 py-1 text-xs font-bold text-red-800 bg-red-200 rounded-full">{{ $reservation->status }}</span>
                                        @endif
                                    </td>
                                    <td class="py-2 px-4 border-b">
                                        <div class="flex flex-col space-y-2 sm:flex-row sm:space-y-0 sm:space-x-2">
                                            @if ($reservationDateTime->isPast() || ($reservationDateTime->isToday() && $currentDateTime->gt($reservationDateTime)))
                                                <span class="text-red-500">Lapsed</span>
                                                <div>
                                                    <select name="status_{{ $reservation->id }}" class="border rounded">
                                                        <option value="">Select status</option>
                                                        <option value="attended">Attended</option>
                                                        <option value="forfeited">Forfeited</option>
                                                        <option value="finished">Finished</option>
                                                    </select>
                                                </div>
                                            @else
                                                <a href="{{ route('admin.approve', $reservation->id) }}"
                                                    class="inline-block px-3 py-2 text-white bg-blue-500 rounded hover:bg-blue-700">Approve</a>
                                                <a href="{{ route('admin.reject', $reservation->id) }}"
                                                    class="inline-block px-3 py-2 text-white bg-red-500 rounded hover:bg-red-700">Reject</a>
                                            @endif
                                        </div>
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
