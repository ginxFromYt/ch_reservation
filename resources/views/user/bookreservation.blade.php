<x-app-layout>

    <!-- Flash Messages -->
    @if (session('success'))
        <div class="bg-green-500 text-white p-4 rounded">
            {{ session('success') }}
        </div>
    @endif  

    @if (session('error'))
        <div class="bg-red-500 text-white p-4 rounded">
            {{ session('error') }}
        </div>
    @endif

    <div class="min-h-screen flex flex-col items-center justify-center bg-gray-100 p-4 sm:p-6 lg:p-8">
        <div class="flex flex-col lg:flex-row lg:space-x-6 w-full max-w-7xl">
            <!-- First Card -->
            <div class="bg-white shadow-md rounded-lg w-full lg:w-1/2 p-6 mb-5 lg:mb-0">
                <h2 class="text-2xl font-semibold text-gray-800 mb-6 text-center">Book a Reservation</h2>

                <form action="{{ route('user.proceedreservation') }}" method="POST" enctype="multipart/form-data"
                    class="space-y-4">
                    @csrf
                    <!-- Event Selection -->
                    <div>
                        <label for="event" class="block text-sm font-medium text-gray-700">Select Event</label>
                        <select id="event" name="event_id"
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            onchange="updateDatePicker(); toggleBaptismForm();">
                            <option value="">Choose an event</option>
                            @foreach ($events as $event)
                                <option value="{{ $event->id }}" @if ($event->name === 'Sunday Mass' || $event->name === 'Christmas Eve Mass') disabled @endif>
                                    {{ $event->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Date -->
                    <div>
                        <label for="reservation_date" class="block text-sm font-medium text-gray-700">Select
                            Date</label>
                        <input type="text" id="reservation_date" name="reservation_date"
                            class="flatpickr mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            required>
                    </div>

                    <!-- Time -->
                    <div>
                        <label for="reservation_time" class="block text-sm font-medium text-gray-700">Select Time
                            <span class="text-xs text-gray-500">(Format: hh:mm AM/PM. Please choose from the listed
                                options.)</span>
                        </label>
                        <input type="text" id="reservation_time" name="reservation_time"
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            required>
                    </div>

                    <!-- Number of Attendees -->
                    <div>
                        <label for="number_of_people" class="block text-sm font-medium text-gray-700">Number of
                            Attendees</label>
                        <input type="number" id="number_of_people" name="number_of_people" min="1"
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            required>
                    </div>

                    <!-- Additional Child Form (hidden by default) -->
                    <div id="baptismForm" style="display: none;">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Baptism Details</h3>

                        <!-- Child Information -->
                        <div>
                            <label for="child_name" class="block text-sm font-medium text-gray-700">Child's Full
                                Name</label>
                            <input type="text" id="child_name" name="child_name"
                                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>

                        <div>
                            <label for="child_birthday" class="block text-sm font-medium text-gray-700">Child's
                                Birthdate</label>
                            <input type="date" id="child_birthday" name="child_birthday"
                                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>

                        <div>
                            <label for="child_birthplace" class="block text-sm font-medium text-gray-700">Child's
                                Birthplace</label>
                            <input type="text" id="child_birthplace" name="child_birthplace"
                                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>

                        <!-- Mother's Information -->
                        <h4 class="text-md font-medium text-gray-700 mt-4">Mother's Information</h4>
                        <div>
                            <label for="mother_name" class="block text-sm font-medium text-gray-700">Mother's Full
                                Name</label>
                            <input type="text" id="mother_name" name="mother_name"
                                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>

                        <div>
                            <label for="mother_birthday" class="block text-sm font-medium text-gray-700">Mother's
                                Birthday</label>
                            <input type="date" id="mother_birthday" name="mother_birthday"
                                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>

                        <!-- Father's Information -->
                        <h4 class="text-md font-medium text-gray-700 mt-4">Father's Information</h4>
                        <div>
                            <label for="father_name" class="block text-sm font-medium text-gray-700">Father's Full
                                Name</label>
                            <input type="text" id="father_name" name="father_name"
                                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>

                        <div>
                            <label for="father_birthday" class="block text-sm font-medium text-gray-700">Father's
                                Birthday</label>
                            <input type="date" id="father_birthday" name="father_birthday"
                                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>

                        <!-- Sponsors Information -->
                        <h4 class="text-md font-medium text-gray-700 mt-4">Sponsors Information</h4>
                        <div>
                            <label for="sponsor_male" class="block text-sm font-medium text-gray-700">Major Sponsor
                                (Male)</label>
                            <input type="text" id="sponsor_male" name="sponsor_male"
                                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>

                        <div>
                            <label for="sponsor_female" class="block text-sm font-medium text-gray-700">Major Sponsor
                                (Female)</label>
                            <input type="text" id="sponsor_female" name="sponsor_female"
                                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>
                    </div>

                    {{-- for wedding  --}}
                    <div id="weddingForm" style="display: none;">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Wedding Details</h3>

                        <div>
                            <label for="bride_name" class="block text-sm font-medium text-gray-700">Bride Name</label>
                            <input type="text" id="bride_name" name="bride_name"
                                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>

                        <div>
                            <label for="groom_name" class="block text-sm font-medium text-gray-700">Groom Name</label>
                            <input type="text" id="groom_name" name="groom_name"
                                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>

                        <div>
                            <label for="marriage_license" class="block text-sm font-medium text-gray-700">Marriage
                                License</label>
                            <input type="file" id="marriage_license" name="marriage_license" min="1"
                                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>

                        <div>
                            <label for="wedding_notes" class="block text-sm font-medium text-gray-700">Special
                                Notes</label>
                            <textarea id="wedding_notes" name="wedding_notes"
                                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
                        </div>
                    </div>

                    <div id="burialForm" style="display: none;">
                        <div>
                            <label for="name_deceased" class="block text-sm font-medium text-gray-700">Name of
                                Deceased</label>
                            <input type="text" id="name_deceased" name="name_deceased"
                                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>

                        <div>
                            <label for="date_death" class="block text-sm font-medium text-gray-700">Date of
                                Death</label>
                            <input type="date" id="date_death" name="date_death"
                                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>

                        <div>
                            <label for="time_death" class="block text-sm font-medium text-gray-700">Time of
                                Death</label>
                            <input type="time" id="time_death" name="time_death"
                                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>

                        <div>
                            <label for="contact_person" class="block text-sm font-medium text-gray-700">Contact
                                Person/Next of Kin</label>
                            <input type="text" id="contact_person" name="contact_person"
                                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>

                        <div>
                            <label for="relationship"
                                class="block text-sm font-medium text-gray-700">Relationship</label>
                            <input type="text" id="relationship" name="relationship"
                                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>

                        <div>
                            <label for="contact_number" class="block text-sm font-medium text-gray-700">Contact
                                Number</label>
                            <input type="text" id="contact_number" name="contact_number"
                                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" id="email" name="email"
                                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div>
                        <button type="submit"
                            class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                            Submit Reservation
                        </button>
                    </div>
                </form>
            </div>

            <!-- Second Card -->
            <div class="bg-white shadow-md rounded-lg w-full lg:w-1/2 p-3 mx-auto flex flex-col items-center">
                <h2 class="text-2xl font-semibold text-black mb-1">Event Calendar</h2>
                <div class="text-start p-5">

                    <p class="text-sm text-gray-600 mt-2 font-extrabold">
                       Note: Dates on <span class="text-fuchsia-500 font-bold">Mondays and Sundays</span> are disabled because they
                        are reserved for Regular Mass Schedules.
                    </p>
                    <p class="text-sm text-gray-600 mt-2">
                        <span class="text-red-500">**Days marked in red are fully booked.**</span>
                    </p>
                    <p class="text-sm text-gray-600 mt-2">
                        <span class="text-green-500">**Days marked in green have vacant reservation times.**</span>
                    </p>
                    <p class="text-sm text-gray-600 mt-2 font-extrabold">
                        Also Note: You might pick a valid date and time but the acceptance of the reservaation may be based on the priests discression.
                    </p>
                </div>
                <div id="calendar" class="mx-auto"></div>
            </div>
        </div>
    </div>

    <script>
        @php
            // Get all approved reservations
            $approvedReservations = DB::table('reservations')->where('status', 'approved')->get();
            // Convert the reserved dates and times to an array
            $reservedDatesTime = $approvedReservations
                ->map(function ($reservation) {
                    return [
                        'date' => $reservation->reservation_date,
                        'time' => $reservation->reservation_time,
                    ];
                })
                ->toArray();
        @endphp

        document.addEventListener('DOMContentLoaded', function() {
            const reservedDatesTime = @json($reservedDatesTime);

            // Initialize the calendar
            flatpickr("#calendar", {
                inline: true, // Keep the calendar always visible
                dateFormat: "Y-m-d",
                defaultDate: "today",
                minDate: "today",
                disable: [
                    date => date.getDay() === 0 || date.getDay() ===
                    1 // Disable Sundays (0) and Mondays (1)
                ],
                locale: {
                    firstDayOfWeek: 1 // Optional: Start the calendar with Monday
                },
                onDayCreate: (dObj, dStr, fp, dayElem) => {
                    // Convert the date element to a string format
                    const dateStr = dayElem.dateObj.toISOString().split('T')[0];
                    // Get reserved times for the current date element
                    const reservedTimes = reservedDatesTime.filter(reservation => reservation.date ===
                        dateStr).map(reservation => reservation.time);

                    // Mark Sundays and Mondays with a gray background and black text
                    if (dayElem.dateObj.getDay() === 0 || dayElem.dateObj.getDay() === 1) {
                        dayElem.style.backgroundColor = '#d946ef';
                        dayElem.style.color = '#000000'; // Set text color to black
                    }

                    // Highlight dates with approved reservations with a light green background
                    if (reservedTimes.length > 0) {
                        dayElem.style.backgroundColor = '#90ee90'; // Light green
                        dayElem.dataset.reservedTimes = JSON.stringify(
                            reservedTimes); // Store reserved times in the element
                        dayElem.title = 'Reserved times: ' + reservedTimes.join(
                            ', '); // Show tooltip with reserved times
                    }

                    // Prevent clicking but keep hover functionality intact
                    dayElem.classList.add('click-disabled');
                },
                onDayHover: (date, dayElem) => {
                    // Keep hover interaction active and show tooltip if there are reserved times
                    if (dayElem.dataset.reservedTimes) {
                        dayElem.style.cursor =
                            'pointer'; // Show pointer cursor to indicate there’s info
                    } else {
                        dayElem.style.cursor = 'not-allowed'; // Show not-allowed cursor for other dates
                    }
                },
                onChange: (selectedDates, dateStr, instance) => {
                    // Prevent date selection by immediately deselecting the date
                    instance.clear();
                },
                onDayClick: (date, dayElem, instance) => {
                    // Prevent date selection and show a message instead
                    instance.clear(); // Clear any selected date
                    alert('Date selection is disabled. Please select a date from the form.');
                },
                onClose: (selectedDates, dateStr, instance) => {
                    // Re-open the calendar if it gets closed
                    instance.open();
                },
                clickOpens: false // Completely disable date picking functionality
            });

            // CSS to disable clicking but keep hover and tooltip active
            const style = document.createElement('style');
            style.innerHTML = `
                    .click-disabled {
                        pointer-events: auto; /* Keep hover events enabled */
                        cursor: default; /* Change cursor to default for disabled clicks */
                    }
                    .click-disabled:active {
                        pointer-events: none; /* Disable click on active state */
                    }
                `;
            document.head.appendChild(style);

            document.head.appendChild(style);

            // Control the time selection
            flatpickr("#reservation_time", {
                enableTime: true,
                noCalendar: true,
                dateFormat: "h:i K",
                time_24hr: false,
                minuteIncrement: 60,
                onChange: (selectedDates, dateStr, instance) => {
                    const hour24 = selectedDates[0].getHours();
                    const formattedTime24 = `${hour24}:00`;
                    document.getElementById('reservation_time_24').value = formattedTime24;
                }
            });

            let flatpickrInstance;

            function updateDatePicker() {
                const eventSelect = document.getElementById('event');
                const selectedEvent = eventSelect.options[eventSelect.selectedIndex].text;

                let config = {
                    dateFormat: "Y-m-d",
                    minDate: "today",
                    disable: [
                        date => date.getDay() === 0 || date.getDay() === 1
                    ],
                    locale: {
                        firstDayOfWeek: 1
                    }
                };

                if (selectedEvent === "Burial Mass") {
                    config.disable = [
                        date => date.getDay() !== 6
                    ];
                }

                if (flatpickrInstance) {
                    flatpickrInstance.destroy();
                }

                flatpickrInstance = flatpickr("#reservation_date", config);
            }

            flatpickrInstance = flatpickr("#reservation_date", {
                dateFormat: "Y-m-d",
                minDate: "today",
                disable: [
                    date => date.getDay() === 0 || date.getDay() === 1
                ],
                locale: {
                    firstDayOfWeek: 1
                }
            });

            function toggleBaptismForm() {
                const eventSelect = document.getElementById('event');
                const baptismForm = document.getElementById('baptismForm');
                const weddingForm = document.getElementById('weddingForm');
                const burialForm = document.getElementById('burialForm');
                const selectedEvent = eventSelect.options[eventSelect.selectedIndex].text;

                function toggleRequiredFields(form, isRequired) {
                    const inputs = form.querySelectorAll('input, select, textarea');
                    inputs.forEach(input => {
                        if (isRequired) {
                            input.setAttribute('required', 'required');
                        } else {
                            input.removeAttribute('required');
                        }
                    });
                }

                baptismForm.style.display = selectedEvent === "Baptism" ? "block" : "none";
                toggleRequiredFields(baptismForm, selectedEvent === "Baptism");

                weddingForm.style.display = selectedEvent === "Wedding Ceremony" ? "block" : "none";
                toggleRequiredFields(weddingForm, selectedEvent === "Wedding Ceremony");

                burialForm.style.display = selectedEvent === "Burial Mass" ? "block" : "none";
                toggleRequiredFields(burialForm, selectedEvent === "Burial Mass");
            }
        });
    </script>
</x-app-layout>
