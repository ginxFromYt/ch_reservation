@php
    use App\Models\Reservations;
@endphp

<x-app-layout>

    <!-- Flash Messages -->
    @if (session('success') || session('error'))
        <div id="flash-message"
            class="transition-opacity duration-300 ease-in-out opacity-100 bg-{{ session('success') ? 'green-500' : 'red-500' }} text-white p-4 rounded">
            {{ session('success') ?? session('error') }}
        </div>
    @endif


    <div class="min-h-screen flex items-center justify-center bg-gray-100 p-4 sm:p-6 lg:p-8">
        <div class="bg-white shadow-md rounded-lg w-full max-w-md lg:max-w-lg p-6">
            <!-- Header Section -->
            <div class="mb-6 text-center">
                <h2 class="text-2xl font-semibold text-gray-800">Book a Reservation</h2>
                <p class="text-gray-700 text-sm leading-relaxed mt-2">
                    <span class="font-semibold text-red-500 block">For your reference, please check the event calendar in
                        the info Button.</span>
                </p>
            </div>

            <!-- Info Button -->
            <div class="flex justify-end">
                <button id="info-button"
                    class="text-gray-600 hover:text-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-300 rounded-full animate-pulse transition duration-300 ease-in-out">
                    <img src="{{ asset('images/information.png') }}" alt="Information" class="h-6 w-6" />
                </button>
            </div>


            <form action="{{ route('user.proceedreservation') }}" method="POST" enctype="multipart/form-data"
                class="space-y-4">
                @csrf
                <!-- Event Selection -->
                <div>
                    <label for="event" class="block text-sm font-medium text-gray-700">Select Event</label>
                    <select id="event" name="event_id"
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
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
                        <span class="text-xs text-gray-500">(Available times will update based on the selected
                            event.)</span>
                    </label>
                    <select id="reservation_time" name="reservation_time"
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        required>
                        <!-- Options will be dynamically populated -->
                    </select>
                </div>

                <!-- Number of Attendees -->
                {{-- <div>
                    <label for="number_of_people" class="block text-sm font-medium text-gray-700">Number of
                        Attendees</label>
                    <input type="number" id="number_of_people" name="number_of_people" min="1"
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        required>
                </div> --}}

                <div>
                    <label for="contact_number" class="block text-sm font-medium text-gray-700">Contact
                        Number</label>
                    <input type="text" id="contact_number" name="contact_number"
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        required>
                </div>

                <div>
                    <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                    <input type="text" id="address" name="address"
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        required>
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" id="email" name="email"
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        value="{{ Auth::user()->email }}" readonly>
                </div>

                <!-- Additional Child Form (hidden by default) -->
                <div id="baptismForm" class="space-y-4 hidden">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Baptism / Christening Details</h3>
                    <!-- Child Information -->
                    <div>
                        <label for="child_name" class="block text-sm font-medium text-gray-700">Name of Child:</label>
                        <input type="text" id="child_name" name="child_name"
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>

                    <div>
                        <label for="child_birthday" class="block text-sm font-medium text-gray-700">Date of
                            Birth:</label>
                        <input type="date" id="child_birthday" name="child_birthday"
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>

                    <div>
                        <label for="child_birthcert" class="block text-sm font-medium text-gray-700">Birth
                            Certificate:</label>
                        <input type="file" id="child_birthcert" name="child_birthcert"
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <p class="mt-2 text-sm text-gray-500">
                            If uploading a scanned copy of the child's birth certificate, please bring a hard copy to
                            the church on the day of the reservation.
                        </p>
                    </div>

                    <div>
                        <label for="child_birthplace" class="block text-sm font-medium text-gray-700">Place of
                            Birth:</label>
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

                    <div>
                        <label for="mother_birthplace" class="block text-sm font-medium text-gray-700">Mother's Birth
                            Place</label>
                        <input type="text" id="mother_birthplace" name="mother_birthplace"
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>

                    <div>
                        <label for="mother_religion" class="block text-sm font-medium text-gray-700">Mother's
                            Religion</label>
                        <input type="text" id="mother_religion" name="mother_religion"
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

                    <div>
                        <label for="father_birthplace" class="block text-sm font-medium text-gray-700">Father's Birth
                            Place</label>
                        <input type="text" id="father_birthplace" name="father_birthplace"
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>

                    <div>
                        <label for="father_religion" class="block text-sm font-medium text-gray-700">Father's
                            Religion</label>
                        <input type="text" id="father_religion" name="father_religion"
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

                    <p class="mt-2 text-sm text-gray-500">
                        Please bring the list of additional sponsors on the day of the event if approved.
                    </p>

                </div>

                {{-- for wedding details --}}
                <div id="weddingForm" style="display: none;">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Wedding Details</h3>

                    <fieldset class="mb-6 border p-4 rounded-md">
                        <legend class="font-semibold text-gray-700">Groom's Information</legend>

                        <label for="groom_name" class="block text-sm font-medium text-gray-700">Full Name</label>
                        <input type="text" id="groom_name" name="groom_name"
                            class="mt-1 block w-full px-4 py-2 border rounded-md">

                        <label for="groom_birthdate" class="block text-sm font-medium mt-4 text-gray-700">Date of
                            Birth</label>
                        <input type="date" id="groom_birthdate" name="groom_birthdate"
                            class="mt-1 block w-full px-4 py-2 border rounded-md">

                        <label for="groom_age" class="block text-sm font-medium mt-4 text-gray-700">Age</label>
                        <input type="number" id="groom_age" name="groom_age"
                            class="mt-1 block w-full px-4 py-2 border rounded-md">

                        <label for="groom_birthplace" class="block text-sm font-medium mt-4 text-gray-700">Place of
                            Birth</label>
                        <input type="text" id="groom_birthplace" name="groom_birthplace"
                            class="mt-1 block w-full px-4 py-2 border rounded-md">

                        <label for="groom_address"
                            class="block text-sm font-medium mt-4 text-gray-700">Address</label>
                        <input type="text" id="groom_address" name="groom_address"
                            class="mt-1 block w-full px-4 py-2 border rounded-md">

                        <label for="groom_father" class="block text-sm font-medium mt-4 text-gray-700">Father's
                            Name</label>
                        <input type="text" id="groom_father" name="groom_father"
                            class="mt-1 block w-full px-4 py-2 border rounded-md">

                        <label for="groom_mother" class="block text-sm font-medium mt-4 text-gray-700">Mother's
                            Name</label>
                        <input type="text" id="groom_mother" name="groom_mother"
                            class="mt-1 block w-full px-4 py-2 border rounded-md">

                        <label for="groom_job" class="block text-sm font-medium mt-4 text-gray-700">Job</label>
                        <input type="text" id="groom_job" name="groom_job"
                            class="mt-1 block w-full px-4 py-2 border rounded-md">

                        <label for="groom_religion"
                            class="block text-sm font-medium mt-4 text-gray-700">Religion</label>
                        <input type="text" id="groom_religion" name="groom_religion"
                            class="mt-1 block w-full px-4 py-2 border rounded-md">
                    </fieldset>

                    <!-- Bride's Information -->
                    <fieldset class="mb-6 border p-4 rounded-md">
                        <legend class="font-semibold text-gray-700">Bride's Information</legend>

                        <label for="bride_name" class="block text-sm font-medium text-gray-700">Full Name</label>
                        <input type="text" id="bride_name" name="bride_name"
                            class="mt-1 block w-full px-4 py-2 border rounded-md">

                        <label for="bride_birthdate" class="block text-sm font-medium mt-4 text-gray-700">Date of
                            Birth</label>
                        <input type="date" id="bride_birthdate" name="bride_birthdate"
                            class="mt-1 block w-full px-4 py-2 border rounded-md">

                        <label for="bride_age" class="block text-sm font-medium mt-4 text-gray-700">Age</label>
                        <input type="number" id="bride_age" name="bride_age"
                            class="mt-1 block w-full px-4 py-2 border rounded-md">

                        <label for="bride_birthplace" class="block text-sm font-medium mt-4 text-gray-700">Place of
                            Birth</label>
                        <input type="text" id="bride_birthplace" name="bride_birthplace"
                            class="mt-1 block w-full px-4 py-2 border rounded-md">

                        <label for="bride_address"
                            class="block text-sm font-medium mt-4 text-gray-700">Address</label>
                        <input type="text" id="bride_address" name="bride_address"
                            class="mt-1 block w-full px-4 py-2 border rounded-md">

                        <label for="bride_father" class="block text-sm font-medium mt-4 text-gray-700">Father's
                            Name</label>
                        <input type="text" id="bride_father" name="bride_father"
                            class="mt-1 block w-full px-4 py-2 border rounded-md">

                        <label for="bride_mother" class="block text-sm font-medium mt-4 text-gray-700">Mother's
                            Name</label>
                        <input type="text" id="bride_mother" name="bride_mother"
                            class="mt-1 block w-full px-4 py-2 border rounded-md">

                        <label for="bride_job" class="block text-sm font-medium mt-4 text-gray-700">Job</label>
                        <input type="text" id="bride_job" name="bride_job"
                            class="mt-1 block w-full px-4 py-2 border rounded-md">

                        <label for="bride_religion"
                            class="block text-sm font-medium mt-4 text-gray-700">Religion</label>
                        <input type="text" id="bride_religion" name="bride_religion"
                            class="mt-1 block w-full px-4 py-2 border rounded-md">
                    </fieldset>

                    <!-- Sponsors -->
                    <fieldset class="mb-6 border p-4 rounded-md">
                        <legend class="font-semibold text-gray-700">Sponsors</legend>

                        <label for="sponsor_ninong1" class="block text-sm font-medium text-gray-700">Ninong 1</label>
                        <input type="text" id="sponsor_ninong1" name="sponsor_ninong1"
                            class="mt-1 block w-full px-4 py-2 border rounded-md">

                        <label for="sponsor_ninang1" class="block text-sm font-medium mt-4 text-gray-700">Ninang
                            1</label>
                        <input type="text" id="sponsor_ninang1" name="sponsor_ninang1"
                            class="mt-1 block w-full px-4 py-2 border rounded-md">

                        <label for="sponsor_ninong2" class="block text-sm font-medium mt-4 text-gray-700">Ninong
                            2</label>
                        <input type="text" id="sponsor_ninong2" name="sponsor_ninong2"
                            class="mt-1 block w-full px-4 py-2 border rounded-md">

                        <label for="sponsor_ninang2" class="block text-sm font-medium mt-4 text-gray-700">Ninang
                            2</label>
                        <input type="text" id="sponsor_ninang2" name="sponsor_ninang2"
                            class="mt-1 block w-full px-4 py-2 border rounded-md">
                    </fieldset>

                    <!-- Marriage License -->
                    <fieldset class="mb-6 border p-4 rounded-md">
                        <legend class="font-semibold text-gray-700">Marriage License</legend>

                        <label for="marriage_file" class="block text-sm font-medium text-gray-700">Upload Marriage
                            License</label>
                        <input type="file" id="marriage_file" name="marriage_file" accept=".pdf,.jpg,.jpeg,.png"
                            class="mt-1 block w-full px-4 py-2 border rounded-md">
                    </fieldset>
                </div>

                <!-- Burial/interment Form -->
                <div id="burialForm" style="display: none;">
                    <div>
                        <label for="name_deceased" class="block text-sm font-medium text-gray-700">Name of
                            Deceased</label>
                        <input type="text" id="name_deceased" name="name_deceased"
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>

                    <div>
                        <label for="date_birth" class="block text-sm font-medium text-gray-700">Date of Birth</label>
                        <input type="date" id="date_birth" name="date_birth"
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
                        <label for="cert_death" class="block text-sm font-medium text-gray-700">Death
                            Certificate</label>
                        <input type="file" id="cert_death" name="cert_death"
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>

                    <div>
                        <label for="age_deceased" class="block text-sm font-medium text-gray-700">Age at Death</label>
                        <input type="number" id="age_deceased" name="age_deceased"
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>

                    <div>
                        <label for="civil_status" class="block text-sm font-medium text-gray-700">Civil Status</label>
                        <select id="civil_status" name="civil_status"
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="">Select</option>
                            <option value="single">Single</option>
                            <option value="married">Married</option>
                            <option value="widow">Widow</option>
                        </select>
                    </div>

                    <div>
                        <label for="cause_death" class="block text-sm font-medium text-gray-700">Cause of
                            Death</label>
                        <input type="text" id="cause_death" name="cause_death"
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>

                    <div>
                        <label for="place_burial" class="block text-sm font-medium text-gray-700">Place of
                            Burial</label>
                        <input type="text" id="place_burial" name="place_burial"
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>

                    {{-- <div>
                        <label for="burial_date" class="block text-sm font-medium text-gray-700">Date of
                            Burial</label>
                        <input type="date" id="burial_date" name="burial_date"
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div> --}}

                    {{-- <div>
                        <label for="time_burial" class="block text-sm font-medium text-gray-700">Time of
                            Burial</label>
                        <input type="time" id="time_burial" name="time_burial"
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div> --}}

                    <div>
                        <label for="contact_person" class="block text-sm font-medium text-gray-700">Contact
                            Person</label>
                        <input type="text" id="contact_person" name="contact_person"
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>

                    <div>
                        <label for="relationship" class="block text-sm font-medium text-gray-700">Relationship to
                            Deceased</label>
                        <input type="text" id="relationship" name="relationship"
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

        <!-- Calendar Modal -->
        <div id="info-modal" class="fixed inset-0 bg-gray-800 bg-opacity-50 items-center justify-center z-50 hidden">
            <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Event Calendar FYI</h3>
                <p class="text-gray-700 text-sm leading-relaxed">
                    <span class="font-semibold text-red-500">Red</span> - Fully booked,
                    <span class="font-semibold text-green-500">Green</span> - Has reservations with Available slots.
                </p>

                <!-- Calendar Table -->
                <div class="overflow-x-auto">
                    <!-- Month and Year Header -->
                    <div class="flex justify-between items-center mb-4">
                        <button id="prev-month" class="px-4 py-2 text-white bg-blue-500 rounded">Prev</button>
                        <div id="month-year" class="text-xl font-semibold text-gray-800"></div>
                        <button id="next-month" class="px-4 py-2 text-white bg-blue-500 rounded">Next</button>
                    </div>

                    <!-- Calendar -->
                    <table class="min-w-full table-auto border-collapse">
                        <thead>
                            <tr class="bg-gray-200 text-gray-700">
                                <th class="px-4 py-2 border border-gray-300">Sun</th>
                                <th class="px-4 py-2 border border-gray-300">Mon</th>
                                <th class="px-4 py-2 border border-gray-300">Tue</th>
                                <th class="px-4 py-2 border border-gray-300">Wed</th>
                                <th class="px-4 py-2 border border-gray-300">Thu</th>
                                <th class="px-4 py-2 border border-gray-300">Fri</th>
                                <th class="px-4 py-2 border border-gray-300">Sat</th>
                            </tr>
                        </thead>
                        <tbody id="calendar-body">
                            <!-- Calendar Days will be dynamically populated here -->
                        </tbody>
                    </table>
                </div>

                <!-- Close Button -->
                <button id="close-modal"
                    class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-300 mt-4">
                    Close
                </button>
            </div>
        </div>


        <!-- Add the modal HTML -->
        <div id="eventRulesModal"
            class="fixed inset-0 bg-gray-800 bg-opacity-50 items-center flex justify-center z-50">
            <div class="bg-white rounded-lg shadow-lg p-6 w-4/5 md:w-1/3">
                <h2 id="modalTitle" class="text-lg font-bold mb-4 text-gray-800"></h2>
                <p id="modalContent" class="text-sm text-gray-700 mb-4"></p>
                <button id="closeModalButton" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    Close
                </button>
            </div>
        </div>
    </div>


    <script>
        @php
            $approvedReservations = DB::table('reservations')->where('status', 'approved')->get();
            $fullyBookedReservations = DB::table('reservations')->where('status', 'pending')->get();
            $reservedDates = Reservations::selectRaw('reservation_date, reservation_time, COUNT(*) as count, event_id')->groupBy('reservation_date', 'reservation_time', 'event_id')->get()->groupBy('reservation_date');

            $fullyBookedDates = [];
            $reservedDatesTime = [];

            // Process reservation data
            foreach ($reservedDates as $date => $reservations) {
                foreach ($reservations as $reservation) {
                    // Check fully booked slots (customize these limits as needed)
                    $limit = $reservation->event_id === 2 ? 2 : 3; // 2 for weddings, 3 for burials
                    if ($reservation->count >= $limit) {
                        $fullyBookedDates[] = $date;
                    } else {
                        $reservedDatesTime[] = [
                            'date' => $date,
                            'time' => $reservation->reservation_time,
                            'count' => $reservation->count,
                            'event_id' => $reservation->event_id,
                        ];
                    }
                }
            }

            // dd($fullyBookedDates, $reservedDatesTime);

        @endphp

        document.addEventListener("DOMContentLoaded", function() {
            const reservedDatesTime = @json($reservedDatesTime);
            const fullyBookedDates = @json($fullyBookedDates);

            let flatpickrDateInstance;

            const flashMessage = document.getElementById('flash-message');

            if (flashMessage) {
                setTimeout(() => {
                    flashMessage.classList.add('opacity-0');
                    // Optionally, remove the element from the DOM after fading out
                    setTimeout(() => {
                        flashMessage.remove();
                    }, 300); // Matches the duration-300 for the fade-out animation
                }, 3000); // 3 seconds delay before fade-out starts
            }

            // Function to update the date picker
            function updateDatePicker() {
                const eventSelect = document.getElementById('event');
                const selectedEvent = eventSelect.options[eventSelect.selectedIndex]?.text || "";

                let config = {
                    dateFormat: "Y-m-d",
                    minDate: "today",
                    locale: {
                        firstDayOfWeek: 1
                    },
                    disable: [],
                    onDayCreate: function(dObj, dStr, fp, dayElem) {
                        if (!(dObj instanceof Date)) {
                            dObj = new Date(dObj);
                        }

                        const dateStr = fp.formatDate(dObj, "Y-m-d");

                        // Check if the date is reserved (approved or fully booked)
                        if (reservedDatesTime.some(res => res.date === dateStr)) {
                            dayElem.style.backgroundColor = "green";
                            dayElem.style.color = "white";
                        }

                        if (fullyBookedDates.includes(dateStr)) {
                            dayElem.style.backgroundColor = "red";
                            dayElem.style.color = "white";
                        }
                    }
                };

                switch (selectedEvent) {
                    case "Baptism":
                        config.disable = [
                            function(date) {
                                return date.getDay() !== 6;
                            },
                        ];
                        break;

                    case "Burial Mass":
                        config.disable = [
                            function(date) {
                                const day = date.getDay();
                                const fiveDaysFromNow = new Date();
                                fiveDaysFromNow.setDate(fiveDaysFromNow.getDate() + 5);
                                return day < 2 || day > 6 || date < fiveDaysFromNow;
                            },
                        ];
                        break;

                    case "Wedding Ceremony":
                        config.disable = [
                            function(date) {
                                const day = date.getDay();
                                return !(day === 0 || day === 1);
                            },
                        ];
                        break;
                }

                if (flatpickrDateInstance && typeof flatpickrDateInstance.destroy === "function") {
                    flatpickrDateInstance.destroy();
                }

                flatpickrDateInstance = flatpickr("#reservation_date", config);
            }

            // Function to update the time picker
            function updateTimePicker() {
                const eventSelect = document.getElementById('event');
                const selectedEvent = eventSelect.options[eventSelect.selectedIndex]?.text || "";
                const dateInput = document.getElementById('reservation_date').value;
                const timeSelect = document.getElementById('reservation_time');

                timeSelect.innerHTML = ""; // Clear previous options
                let availableTimes = [];

                // Define available times based on the selected event
                switch (selectedEvent) {
                    case "Baptism":
                        availableTimes = ["9:30 AM"];
                        break;

                    case "Burial Mass":
                        availableTimes = ["8:00 AM", "2:00 PM"];
                        break;

                    case "Wedding Ceremony":
                        availableTimes = ["9:30 AM", "2:00 PM"];
                        break;

                    default:
                        availableTimes = [];
                        break;
                }

                // Remove reserved times for the selected date
                if (dateInput) {
                    availableTimes = availableTimes.filter(time => {
                        return !reservedDatesTime.some(reserved =>
                            reserved.date === dateInput && reserved.time === time
                        );
                    });
                }

                if (availableTimes.length > 0) {
                    availableTimes.forEach((time) => {
                        const option = document.createElement("option");
                        option.value = time;
                        option.textContent = time;
                        timeSelect.appendChild(option);
                    });
                } else {
                    const defaultOption = document.createElement("option");
                    defaultOption.value = "";
                    defaultOption.textContent = "No available times for the selected date";
                    defaultOption.disabled = true;
                    defaultOption.selected = true;
                    timeSelect.appendChild(defaultOption);
                }
            }

            // Toggle forms visibility based on the selected event
            function toggleForms() {
                const eventSelect = document.getElementById('event');
                const selectedEvent = eventSelect.options[eventSelect.selectedIndex]?.text || "";

                const baptismForm = document.getElementById('baptismForm');
                const weddingForm = document.getElementById('weddingForm');
                const burialForm = document.getElementById('burialForm');

                // Display the appropriate form
                if (baptismForm) baptismForm.style.display = selectedEvent === "Baptism" ? "block" : "none";
                if (weddingForm) weddingForm.style.display = selectedEvent === "Wedding Ceremony" ? "block" :
                    "none";
                if (burialForm) burialForm.style.display = selectedEvent === "Burial Mass" ? "block" : "none";

                // Make fields required for active forms only
                setRequiredFields(baptismForm, selectedEvent === "Baptism");
                setRequiredFields(weddingForm, selectedEvent === "Wedding Ceremony");
                setRequiredFields(burialForm, selectedEvent === "Burial Mass");

                updateDatePicker();
                updateTimePicker();
            }

            // Helper function to toggle required attribute
            function setRequiredFields(form, isActive) {
                if (form) {
                    const inputs = form.querySelectorAll("input, textarea, select");
                    inputs.forEach(input => {
                        input.required = isActive;
                    });
                }
            }


            // Modal logic for event rules
            const modal = document.getElementById("eventRulesModal");
            const modalTitle = document.getElementById("modalTitle");
            const modalContent = document.getElementById("modalContent");
            const closeModalButton = document.getElementById("closeModalButton");

            const eventRules = {
                "Baptism": {
                    title: "Baptism/Christening Reservation Rules",
                    content: "Only Saturdays are available. Time is restricted to 9:30 AM.",
                },
                "Burial Mass": {
                    title: "Burial/Internment  Reservation Rules",
                    content: "Available days: Tuesday to Saturday. Time: 8:00 AM or 2:00 PM. Requirements must be submitted at least 5 days before the intended schedule.",
                },
                "Wedding Ceremony": {
                    title: "Wedding Reservation Rules",
                    content: "Only Sundays and Mondays are available. Time: 9:30 AM or 2:00 PM.",
                },
                "default": {
                    title: "Event Reservation Selection",
                    content: "Please select an event to view the corresponding rules.",
                },
            };

            function showEventRulesModal(eventName) {
                const rules = eventRules[eventName] || eventRules["default"];
                modalTitle.textContent = rules.title;
                modalContent.textContent = rules.content;
                modal.classList.remove("hidden");
            }

            closeModalButton.addEventListener("click", function() {
                modal.classList.add("hidden");
            });

            // Event listeners for modal and form toggling for the info calendar
            const eventSelect = document.getElementById("event");
            const dateInput = document.getElementById("reservation_date");

            if (eventSelect) {
                eventSelect.addEventListener("change", function() {
                    const selectedEvent = eventSelect.options[eventSelect.selectedIndex]?.text || "default";
                    showEventRulesModal(selectedEvent);
                    toggleForms();
                });

                dateInput.addEventListener("change", updateTimePicker);

                // Show rules for the initially selected event
                const initialSelectedEvent = eventSelect.options[eventSelect.selectedIndex]?.text || "default";
                showEventRulesModal(initialSelectedEvent);

                toggleForms(); // Initialize on page load
            }


            const infoButton = document.getElementById('info-button');
            const infoModal = document.getElementById('info-modal');
            const closeModal = document.getElementById('close-modal');
            // const fetchReservationUrl = "{{ route('user.fetchreservation') }}";
            let reservationData = {};

            // Show the modal and fetch data
            infoButton.addEventListener('click', () => {
                fetch('{{ route('user.fetchreservation') }}') // Laravel route using Blade syntax
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(`HTTP error! status: ${response.status}`);
                        }
                        return response.json(); // Parse JSON response
                    })
                    .then(data => {
                        console.log(data); // Log the fetched data to the console
                        processReservationData(data); // Populate reservationData

                        // Render the calendar AFTER data processing
                        updateMonthYear();
                        updateCalendar();

                        // Show the modal
                        infoModal.classList.remove('hidden');
                        infoModal.classList.add('flex');
                    })
                    .catch(error => {
                        console.error('Error fetching reservations:', error);
                        alert('Failed to fetch reservations. Please try again.');
                    });
            });


            function processReservationData(data) {
                reservationData = {}; // Reset data

                data.forEach(reservation => {
                    const date = reservation.reservation_date;
                    const time = reservation.reservation_time.includes('AM') ? 'AM' : 'PM';
                    const eventId = reservation.event_id;
                    const eventName = reservation.event.name;

                    // Initialize date object if not already created
                    if (!reservationData[date]) {
                        reservationData[date] = {
                            event2: {
                                AM: 0,
                                PM: 0,
                                name: ''
                            },
                            event3: {
                                count: 0,
                                name: ''
                            },
                            event5: {
                                AM: 0,
                                PM: 0,
                                name: ''
                            }
                        };
                    }

                    // Add event name to the event types
                    if (eventId === 2) {
                        reservationData[date].event2.name = eventName;
                        reservationData[date].event2[time]++;
                    } else if (eventId === 3) {
                        reservationData[date].event3.name = eventName;
                        reservationData[date].event3.count++;
                    } else if (eventId === 5) {
                        reservationData[date].event5.name = eventName;
                        reservationData[date].event5[time]++;
                    }
                });
            }


            // Hide the modal
            closeModal.addEventListener('click', () => {
                infoModal.classList.remove('flex');
                infoModal.classList.add('hidden');
            });

            // Close modal when clicking outside of it
            infoModal.addEventListener('click', (event) => {
                if (event.target === infoModal) {
                    infoModal.classList.remove('flex');
                    infoModal.classList.add('hidden');
                }
            });

            // Initialize current date
            let currentDate = new Date();

            // Get the month and year header and calendar body
            const monthYearElement = document.getElementById('month-year');
            const calendarBody = document.getElementById('calendar-body');
            const prevButton = document.getElementById('prev-month');
            const nextButton = document.getElementById('next-month');

            // Function to update the month and year header
            function updateMonthYear() {
                const month = currentDate.toLocaleString('default', {
                    month: 'long'
                });
                const year = currentDate.getFullYear();
                monthYearElement.textContent = `${month} ${year}`;
            }

            // Function to update the calendar days
            function updateCalendar() {
                const firstDayOfMonth = new Date(currentDate.getFullYear(), currentDate.getMonth(), 1);
                const lastDayOfMonth = new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, 0);
                const firstDayOfWeek = firstDayOfMonth.getDay();
                const lastDate = lastDayOfMonth.getDate();

                let days = [];
                let day = 1;

                // Create empty cells before the first day of the month
                for (let i = 0; i < firstDayOfWeek; i++) {
                    days.push('<td class="px-4 py-2 border border-gray-300"></td>');
                }

                // Add days of the current month
                for (let i = firstDayOfWeek; day <= lastDate; i++) {
                    const dateKey =
                        `${currentDate.getFullYear()}-${String(currentDate.getMonth() + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
                    const colorClass = getColorClassForDate(dateKey); // Get color class based on rules
                    const tooltipText = getTooltipForDate(dateKey); // Get tooltip text based on reservation data

                    // Add tooltip using the title attribute
                    days.push(`
        <td class="px-4 py-2 border border-gray-300 text-center ${colorClass}" title="${tooltipText}" data-date="${dateKey}">
            ${day}
        </td>
    `);
                    day++;
                }

                // Fill remaining cells with empty cells
                while (days.length % 7 !== 0) {
                    days.push('<td class="px-4 py-2 border border-gray-300"></td>');
                }

                // Group the days into weeks and populate the calendar body
                const weeks = [];
                while (days.length > 0) {
                    weeks.push(days.splice(0, 7));
                }

                // Clear the previous calendar and append new weeks
                calendarBody.innerHTML = '';
                weeks.forEach(week => {
                    const row = document.createElement('tr');
                    week.forEach(day => {
                        row.innerHTML += day;
                    });
                    calendarBody.appendChild(row);
                });

                // Add event listeners to show tooltip on mobile and desktop
                document.querySelectorAll('td[data-date]').forEach(dayElement => {
                    dayElement.addEventListener('mouseenter', function() {
                        // Show tooltip for desktop
                        const date = dayElement.dataset.date;
                        const tooltipText = getTooltipForDate(date);
                        showTooltip(dayElement, tooltipText);
                    });

                    // Use passive: true for touchstart
                    dayElement.addEventListener('touchstart', function() {
                        // Show tooltip for mobile
                        const date = dayElement.dataset.date;
                        const tooltipText = getTooltipForDate(date);
                        showTooltip(dayElement, tooltipText);
                    }, {
                        passive: true
                    });

                    dayElement.addEventListener('mouseleave', function() {
                        // Hide tooltip for desktop
                        hideTooltip();
                    });

                    // Use passive: true for touchend
                    dayElement.addEventListener('touchend', function() {
                        // Hide tooltip for mobile
                        hideTooltip();
                    }, {
                        passive: true
                    });
                });


                // Function to display the tooltip
                function showTooltip(element, text) {
                    let tooltip = document.querySelector('.tooltip');
                    if (!tooltip) {
                        tooltip = document.createElement('div');
                        tooltip.className = 'tooltip';
                        document.body.appendChild(tooltip);
                    }
                    tooltip.innerText = text;

                    const rect = element.getBoundingClientRect();
                    tooltip.style.left = `${rect.left}px`;
                    tooltip.style.top = `${rect.top + rect.height}px`;
                    tooltip.style.display = 'block';
                }

                // Function to hide the tooltip
                function hideTooltip() {
                    const tooltip = document.querySelector('.tooltip');
                    if (tooltip) {
                        tooltip.style.display = 'none';
                    }
                }
            }


            // Determine color class for a specific date
            function getColorClassForDate(date) {
                const data = reservationData[date];

                if (!data) return ''; // No reservations, no color

                // Event ID 2 logic
                if (data.event2.AM === 1 && data.event2.PM === 0 || data.event2.PM === 1 && data.event2.AM === 0) {
                    return 'bg-green-200'; // Green: Only AM or PM
                } else if (data.event2.AM >= 1 && data.event2.PM >= 1) {
                    return 'bg-red-200'; // Red: Both AM and PM
                }

                // Event ID 3 logic
                if (data.event3.count > 0) {
                    return 'bg-green-200'; // Green: All dates
                }

                // Event ID 5 logic
                const totalEvent5 = data.event5.AM + data.event5.PM;
                if (totalEvent5 >= 6) {
                    return 'bg-red-200'; // Red: Maximum of 6 records
                } else if (totalEvent5 < 6) {
                    return 'bg-green-200'; // Green: Vacant slots
                }

                return ''; // Default: No color
            }


            //added tooltip
            function getTooltipForDate(date) {
                const reservations = reservationData[date];

                if (!reservations) return 'No reservations';

                let tooltip = 'Reservations:\n';

                if (reservations.event2) {
                    const event = reservations.event2;
                    if (event.name) {
                        tooltip += `${event.name} - `;
                        if (event.AM > 0) {
                            tooltip += `AM: ${event.AM}\n`;
                        }
                        if (event.PM > 0) {
                            tooltip += `PM: ${event.PM}\n`;
                        }
                    }
                }

                if (reservations.event3) {
                    const event = reservations.event3;
                    if (event.name) {
                        tooltip += `${event.name} - `;
                        if (event.count > 0) {
                            tooltip += `Total: ${event.count}\n`;
                        }
                    }
                }

                if (reservations.event5) {
                    const event = reservations.event5;
                    if (event.name) {
                        tooltip += `${event.name} - `;
                        if (event.AM > 0) {
                            tooltip += `AM: ${event.AM}\n`;
                        }
                        if (event.PM > 0) {
                            tooltip += `PM: ${event.PM}\n`;
                        }
                    }
                }

                return tooltip.trim();
            }

            // Function to handle previous month navigation
            function goToPrevMonth() {
                currentDate.setMonth(currentDate.getMonth() - 1);
                updateMonthYear();
                updateCalendar();
                // Disable prev button if current date is in the past
                if (currentDate.getFullYear() < new Date().getFullYear() ||
                    (currentDate.getFullYear() === new Date().getFullYear() && currentDate.getMonth() <
                        new Date()
                        .getMonth())) {
                    prevButton.disabled = true;
                } else {
                    prevButton.disabled = false;
                }
            }

            // Function to handle next month navigation
            function goToNextMonth() {
                currentDate.setMonth(currentDate.getMonth() + 1);
                updateMonthYear();
                updateCalendar();
                prevButton.disabled = false;
            }

            // Initial rendering
            updateMonthYear();
            updateCalendar();

            // Attach event listeners
            prevButton.addEventListener('click', goToPrevMonth);
            nextButton.addEventListener('click', goToNextMonth);

            // Disable prev button if in the current month
            if (currentDate.getFullYear() === new Date().getFullYear() && currentDate.getMonth() === new Date()
                .getMonth()) {
                prevButton.disabled = true;
            }
        });
    </script>

</x-app-layout>
