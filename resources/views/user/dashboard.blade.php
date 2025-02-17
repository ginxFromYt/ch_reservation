@php
    use Carbon\Carbon;
@endphp

<x-app-layout>
    @php
        // Determine the current or selected month based on query parameters.
        $month = request('month') ? Carbon::parse(request('month')) : Carbon::now();

        // Ensure the month is not before the current month.
        if ($month->lt(Carbon::now()->startOfMonth())) {
            $month = Carbon::now();
        }

        // Format the current month for display (e.g., "October 2024").
        $currentMonth = $month->format('F Y');

        // Calculate the number of days and the starting day of the month (adjusted to start on Monday).
        $daysInMonth = $month->daysInMonth;
        $startOfMonth = ($month->startOfMonth()->dayOfWeek + 6) % 7; // Shift Sunday (0) to last day

        // Generate next and previous months for navigation.
        $nextMonth = $month->copy()->addMonth()->format('Y-m');
        $prevMonth = $month->copy()->subMonth()->format('Y-m');

        // Check if the previous month would go before the current month.
        $canNavigateBack = !$month->eq(Carbon::now()->startOfMonth());

        $reservations = DB::table('reservations')
            ->join('events', 'events.id', 'reservations.event_id')
            ->where('status', 'approved')
            ->get()
            ->groupBy(function ($date) {
                return Carbon::parse($date->reservation_date)->format('Y-m-d');
            });
    @endphp
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <!-- Event Calendar Heading -->
        <div class="mb-6 text-center">
            <h1 class="text-2xl sm:text-4xl font-bold text-gray-800">Event Calendar</h1>
            <p class="text-gray-700 text-sm leading-relaxed">
                <span class="font-semibold text-red-500">Red</span> - Fully booked,
                <span class="font-semibold text-green-500">Green</span> - Has reservations with available slots,
                <span class="font-semibold text-gray-500">Gray</span> - No reservations.
            </p>
        </div>

        <!-- Navigation -->
        <div class="flex flex-wrap justify-between items-center gap-4 mb-4">
            <!-- Back Button -->
            @if ($canNavigateBack)
                <a href="{{ route(request()->route()->getName(), ['month' => $prevMonth]) }}"
                    class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400 text-sm sm:text-base">
                    &larr; Back
                </a>
            @else
                <button class="px-4 py-2 bg-gray-300 rounded cursor-not-allowed text-sm sm:text-base">
                    &larr; Back
                </button>
            @endif

            <!-- Current Month Name -->
            <div class="text-lg sm:text-2xl font-bold text-center">{{ $currentMonth }}</div>

            <!-- Forward Button -->
            <a href="{{ route(request()->route()->getName(), ['month' => $nextMonth]) }}"
                class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400 text-sm sm:text-base">
                Forward &rarr;
            </a>
        </div>

        <!-- Calendar Table -->
        <div class="overflow-x-auto">
            <table class="table-auto w-full border-collapse border border-gray-300 text-sm sm:text-base">
                <!-- Header: Days of the Week -->
                <thead>
                    <tr>
                        <th class="border border-gray-300 px-2 py-1 bg-gray-200">Mon</th>
                        <th class="border border-gray-300 px-2 py-1 bg-gray-200">Tue</th>
                        <th class="border border-gray-300 px-2 py-1 bg-gray-200">Wed</th>
                        <th class="border border-gray-300 px-2 py-1 bg-gray-200">Thu</th>
                        <th class="border border-gray-300 px-2 py-1 bg-gray-200">Fri</th>
                        <th class="border border-gray-300 px-2 py-1 bg-gray-200">Sat</th>
                        <th class="border border-gray-300 px-2 py-1 bg-gray-200">Sun</th>
                    </tr>
                </thead>

                <!-- Calendar Body -->
                <tbody>
                    @php
                        $day = 1;
                        $weeks = ceil(($daysInMonth + $startOfMonth) / 7);
                        $today = Carbon::now();
                    @endphp

                    @for ($i = 0; $i < $weeks; $i++)
                        <tr>
                            @for ($j = 0; $j < 7; $j++)
                                @php
                                    $currentDate = $month->copy()->day($day)->format('Y-m-d');
                                    $currentReservations = $reservations[$currentDate] ?? collect();
                                    $bgColor = 'bg-gray-200'; // Default: No reservation

                                    foreach ($currentReservations as $reservation) {
                                        if ($reservation->name === 'Wedding Ceremony' && $currentReservations->count() > 1) {
                                            $bgColor = 'bg-red-300'; // Red for multiple weddings
                                        } elseif ($reservation->name === 'Wedding Ceremony') {
                                            $bgColor = 'bg-green-200'; // Green for one wedding
                                        } elseif ($reservation->name === 'Burial Mass' && $currentReservations->count() >= 6) {
                                            $bgColor = 'bg-red-300'; // Red for 6 or more burials
                                        } elseif ($reservation->name === 'Burial Mass') {
                                            $bgColor = 'bg-green-200'; // Green for less than 6 burials
                                        } elseif ($reservation->name === 'Baptism') {
                                            $bgColor = 'bg-green-200'; // Green for baptism
                                        }
                                    }
                                @endphp

                                @if (($i === 0 && $j < $startOfMonth) || $day > $daysInMonth)
                                    <td class="border border-gray-300 px-2 py-3 text-center"></td>
                                @else
                                    <td class="border border-gray-300 px-2 py-3 text-center {{ $bgColor }}"
                                        @if ($currentReservations->isNotEmpty()) title="Reservations: {{ $currentReservations->count() }} on {{ $currentDate}}, Event: {{$reservation->name}}" @endif>
                                        @if (
                                            $month->copy()->day($day)->lt($today) ||
                                                $month->copy()->day($day)->isSunday() ||
                                                $month->copy()->day($day)->isMonday())
                                            <button class="cursor-not-allowed text-xs sm:text-sm"
                                                >
                                                {{ $day }}
                                            </button>
                                        @else
                                            <a href="{{ route('user.bookreservation') }}"
                                                class="text-blue-500 hover:underline text-xs sm:text-sm">
                                                {{ $day }}
                                            </a>
                                        @endif
                                    </td>
                                    @php $day++; @endphp
                                @endif
                            @endfor
                        </tr>
                    @endfor
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
