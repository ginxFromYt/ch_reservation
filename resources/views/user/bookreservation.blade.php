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

    <div class="min-h-screen flex items-center justify-center bg-gray-100">
        <div class="bg-white shadow-md rounded-lg w-full max-w-lg p-6">
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
                    <label for="reservation_date" class="block text-sm font-medium text-gray-700">Select Date</label>
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

                    {{-- <div>
                        <label for="wedding_participants" class="block text-sm font-medium text-gray-700">Number of
                            Participants</label>
                        <input type="number" id="wedding_participants" name="wedding_participants" min="1"
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div> --}}

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
                            Diceased</label>
                        <input type="text" id="name_deceased" name="name_deceased"
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>

                    <div>
                        <label for="date_death" class="block text-sm font-medium text-gray-700">Date of Death</label>
                        <input type="date" id="date_death" name="date_death"
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>

                    <div>
                        <label for="time_death" class="block text-sm font-medium text-gray-700">Time of Death</label>
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
                        <label for="relationship" class="block text-sm font-medium text-gray-700">Relationship</label>
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
    </div>

    <script>
        //control the time selection
        flatpickr("#reservation_time", {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            time_24hr: true,
            minuteIncrement: 60, // Only allow hourly intervals
            onChange: function(selectedDates, dateStr, instance) {
                const hour12 = (selectedDates[0].getHours() % 12) || 12;
                const period = selectedDates[0].getHours() < 12 ? 'AM' : 'PM';
                const formattedTime = `${hour12}:00 ${period}`;
                console.log('Formatted Time:', formattedTime);
                // Set hidden input or perform other actions as needed
            }
        });


        // Store the flatpickr instance globally so it can be destroyed
        let flatpickrInstance;



        function updateDatePicker() {
            const eventSelect = document.getElementById('event'); // Properly define eventSelect
            const selectedOption = eventSelect.options[eventSelect.selectedIndex]; // Get the selected option
            const selectedEvent = selectedOption.text; // Get the text of the selected option

            // Default flatpickr settings
            let config = {
                dateFormat: "Y-m-d",
                minDate: "today", // Disable past dates
                disable: [
                    function(date) {
                        // Disable Sundays (0) and Mondays (1)
                        return (date.getDay() === 0 || date.getDay() === 1);
                    }
                ],
                locale: {
                    firstDayOfWeek: 1 // Optional: Start the calendar with Monday
                }
            };

            // If the selected event is Burial Mass, enable only Saturdays
            if (selectedEvent === "Burial Mass") {
                config.disable = [
                    function(date) {
                        // Disable all days except Saturday (6)
                        return date.getDay() !== 6;
                    }
                ];
            }

            // Destroy the previous flatpickr instance if it exists
            if (flatpickrInstance) {
                flatpickrInstance.destroy();
            }

            // Re-initialize flatpickr with updated configuration
            flatpickrInstance = flatpickr("#reservation_date", config);
        }

        // Initialize the datepicker on page load with default settings
        document.addEventListener('DOMContentLoaded', function() {
            flatpickrInstance = flatpickr("#reservation_date", {
                dateFormat: "Y-m-d",
                minDate: "today",
                disable: [
                    function(date) {
                        // Disable Sundays (0) and Mondays (1)
                        return (date.getDay() === 0 || date.getDay() === 1);
                    }
                ],
                locale: {
                    firstDayOfWeek: 1
                }
            });
        });

        function toggleBaptismForm() {
            var eventSelect = document.getElementById('event');
            var baptismForm = document.getElementById('baptismForm');
            var weddingForm = document.getElementById('weddingForm');
            var burialForm = document.getElementById('burialForm');

            // Get the selected event text
            var selectedEvent = eventSelect.options[eventSelect.selectedIndex].text;

            // Utility function to toggle 'required' attribute on form fields
            function toggleRequiredFields(form, isRequired) {
                var inputs = form.querySelectorAll('input, select, textarea');
                inputs.forEach(function(input) {
                    if (isRequired) {
                        input.setAttribute('required', 'required');
                    } else {
                        input.removeAttribute('required');
                    }
                });
            }


            // Show the baptism form only if the selected event is "Baptism"
            if (selectedEvent === "Baptism") {
                baptismForm.style.display = "block";
                toggleRequiredFields(baptismForm, true);
            } else {
                baptismForm.style.display = "none";
                toggleRequiredFields(baptismForm, false);
            }

            // Show/hide the wedding form if "Wedding Ceremony" is selected
            if (selectedEvent === "Wedding Ceremony") {
                weddingForm.style.display = "block";
                toggleRequiredFields(weddingForm, true);
            } else {
                weddingForm.style.display = "none";
                toggleRequiredFields(weddingForm, false);
            }

            // Show/hide the burial form if "Burial Mass" is selected
            if (selectedEvent === "Burial Mass") {
                burialForm.style.display = "block";
                toggleRequiredFields(burialForm, true);
            } else {
                burialForm.style.display = "none";
                toggleRequiredFields(burialForm, false);
            }
        }
    </script>
</x-app-layout>
