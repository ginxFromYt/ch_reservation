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

        // Generate next month for navigation.
        $nextMonth = $month->copy()->addMonth()->format('Y-m');

        $reservations = DB::table('reservations')
            ->where('status', 'approved')
            ->get()
            ->groupBy(function($date) {
            return Carbon::parse($date->reservation_date)->format('Y-m-d');
            });

    @endphp

    <div class="container mx-auto p-6">
        <div class="flex flex-col md:flex-row justify-between items-center mb-4">
            <!-- Back Button (Disabled) -->
            <button class="mb-2 md:mb-0 px-4 py-2 bg-gray-300 rounded cursor-not-allowed" disabled>
                &larr; Back
            </button>

            <!-- Current Month Name -->
            <div class="text-2xl font-bold text-center">{{ $currentMonth }}</div>

            <!-- Forward Button -->
            <a href="{{ route(request()->route()->getName(), ['month' => $nextMonth]) }}"
               class="mb-2 md:mb-0 px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">
                Forward &rarr;
            </a>
        </div>

        <!-- Calendar Table -->
        <div class="overflow-x-auto">
            <table class="table-auto w-full border-collapse border border-gray-300">
                <!-- Header: Days of the Week (Starting from Monday) -->
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

                <!-- Calendar Body: Dates -->
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
                                    $currentDate = $month->copy()->day($day); // Get the current date object
                                @endphp

                                @if (($i === 0 && $j < $startOfMonth) || $day > $daysInMonth)
                                    <td class="border border-gray-300 px-2 py-3 text-center"></td>
                                @else
                                    <td class="border border-gray-300 px-2 py-3 text-center">
                                        @if ($currentDate->lt($today) || $currentDate->isSunday() || $currentDate->isMonday())
                                            <button class="cursor-not-allowed"
                                                    title="This date is not clickable">
                                                {{ $day }}
                                            </button>
                                        @else
                                            <a href=""
                                               class="text-blue-500 hover:underline">
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
