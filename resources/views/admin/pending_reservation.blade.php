<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-200">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="py-2 px-4 border-b border-x border-y">Reservation Name</th>
                                <th class="py-2 px-4 border-b border-x border-y">Customer Name</th>
                                <th class="py-2 px-4 border-b border-x border-y">Customer Email</th>
                                <th class="py-2 px-4 border-b border-x border-y">Reservation Date</th>
                                <th class="py-2 px-4 border-b border-x border-y">Reservation Time</th>
                                <th class="py-2 px-4 border-b border-x border-y">Status</th>
                                <th class="py-2 px-4 border-bborder-x border-y" colspan="2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($reservations->isEmpty())
                                <tr>
                                    <td colspan="8" class="py-2 px-4 border-b text-center">No reservations found.
                                    </td>
                                </tr>
                            @else
                                @foreach ($reservations as $reservation)
                                    <tr class="hover:bg-gray-50">
                                        <td class="py-2 px-4 border-b border-x border-y">{{ $reservation->event_name }}</td>
                                        <td class="py-2 px-4 border-b border-x border-y">{{ $reservation->user_name }}</td>
                                        <td class="py-2 px-4 border-b border-x border-y">{{ $reservation->user_email }}</td>
                                        <td class="py-2 px-4 border-b border-x border-y">{{ $reservation->reservation_date }}</td>
                                        <td class="py-2 px-4 border-b border-x border-y">
                                            {{ carbon\carbon::parse($reservation->reservation_time)->format('h:i A') }}
                                        </td>

                                        {{-- <td class="py-2 px-4 border-b">{{ $reservation->number_of_people }}</td> --}}
                                        <td class="py-2 px-4 border-b border-x border-y">
                                            @if ($reservation->status == 'pending')
                                                <span
                                                    class="inline-block px-2 py-1 text-xs font-bold text-yellow-800 bg-yellow-200 rounded-full">{{ $reservation->status }}</span>
                                            @elseif ($reservation->status == 'approved')
                                                <span
                                                    class="inline-block px-2 py-1 text-xs font-bold text-green-800 bg-green-200 rounded-full">{{ $reservation->status }}</span>
                                            @else
                                                <span
                                                    class="inline-block px-2 py-1 text-xs font-bold text-red-800 bg-red-200 rounded-full">{{ $reservation->status }}</span>
                                            @endif
                                        </td>

                                        <td>
                                            <div class="flex flex-col space-y-2 sm:flex-row sm:space-y-0 sm:space-x-2">
                                                <a href="javascript:void(0)"
                                                    class="viewDetailsBtn inline-block px-3 py-2 text-white bg-green-400 rounded hover:bg-green-700"
                                                    data-event-id="{{ $reservation->event_id }}">View Details</a>

                                            </div>
                                        </td>

                                        <td class="py-2 px-4 border-b">
                                            <div class="flex flex-col space-y-2 sm:flex-row sm:space-y-0 sm:space-x-2">
                                                <a href="{{ route('admin.approve', $reservation->id) }}"
                                                    class="inline-block px-3 py-2 text-white bg-blue-500 rounded hover:bg-blue-700">Approve</a>
                                                {{-- <a href="{{ route('admin.reject', $reservation->id) }}"
                                                class="inline-block px-3 py-2 text-white bg-red-500 rounded hover:bg-red-700">Reject</a> --}}
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Modal Structure -->
                                    <div id="detailsModal"
                                        class="fixed inset-0 flex items-center justify-center z-50 bg-gray-800 bg-opacity-50 hidden">
                                        <div class="bg-white rounded-lg w-96 p-6 overflow-hidden">
                                            <div class="flex justify-between items-center mb-4">
                                                <h3 class="text-lg font-semibold">Reservation Details</h3>
                                                <button id="closeModal"
                                                    class="text-gray-500 hover:text-gray-700">&times;</button>
                                            </div>

                                            <!-- Modal Content: Make the content scrollable if it's long -->
                                            <div id="modalContent" class="max-h-96 overflow-y-auto">
                                                <!-- Dynamic content will be loaded here -->
                                            </div>

                                            <!-- Close Button -->
                                            <div class="mt-4 text-right">
                                                <a href="{{ route('admin.approve', $reservation->id) }}"
                                                    class="inline-block px-3 py-2 text-white bg-blue-500 rounded hover:bg-blue-700">Approve</a>
                                                <button id="closeModalBtn"
                                                    class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-700">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>







    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const detailsModal = document.getElementById('detailsModal');
            const modalContent = document.getElementById('modalContent');
            const closeModal = document.getElementById('closeModal');
            const closeModalBtn = document.getElementById('closeModalBtn');

            // When the View Details button is clicked
            const viewDetailsBtns = document.querySelectorAll('.viewDetailsBtn'); // Select all buttons
            viewDetailsBtns.forEach(button => {
                button.addEventListener('click', function() {
                    const eventId = this.getAttribute('data-event-id');

                    // Show the modal by removing 'hidden' and adding 'flex'
                    detailsModal.classList.remove('hidden');
                    detailsModal.classList.add('flex');

                    // Make an AJAX request to fetch the details
                    fetch(`/admin/view-pending-details/${eventId}`)
                        .then(response => response.json())
                        .then(data => {
                            if (data.error) {
                                modalContent.innerHTML =
                                    `<p class="text-red-500">${data.error}</p>`;
                            } else {
                                let eventDetailsHtml = `
                            <div class="space-y-2">
                                <p><strong>Reservation Date:</strong> ${data.reservation_date}</p>
                                <p><strong>Reservation Time:</strong> ${data.reservation_time}</p>
                                <p><strong>Status:</strong> ${data.status}</p>
                                <hr class="my-4">
                        `;

                                // Check for Wedding Data
                                if (data.groom_name) {
                                    eventDetailsHtml += `
                                <p><strong>Groom's Name:</strong> ${data.groom_name}</p>
                                <p><strong>Groom's Birthday:</strong> ${data.groom_birth_date}</p>
                                <p><strong>Groom's Address:</strong> ${data.groom_address}</p>
                                <p><strong>Bride's Name:</strong> ${data.bride_name}</p>
                                <p><strong>Bride's Birthday:</strong> ${data.bride_birth_date}</p>
                                <p><strong>Bride's Address:</strong> ${data.bride_address}</p>
                                <p><strong>Sponsor (Male):</strong> ${data.sponsor_ninong1}</p>
                                <p><strong>Sponsor (Female):</strong> ${data.sponsor_ninang1}</p>
                                <p><strong>Marriage File:</strong></p>
                                <img src="/storage/${data.marriage_file}" alt="Marriage File" class="w-full mt-2 rounded">
                            `;
                                }

                                // Check for Baptism Data
                                if (data.child_name) {
                                    eventDetailsHtml += `
                                <p><strong>Child's Name:</strong> ${data.child_name}</p>
                                <p><strong>Child's Birthday:</strong> ${data.child_bday}</p>
                                <p><strong>Mother's Name:</strong> ${data.mother_name}</p>
                                <p><strong>Father's Name:</strong> ${data.father_name}</p>
                                <p><strong>Mother's Religion:</strong> ${data.mother_religion}</p>
                                <p><strong>Father's Religion:</strong> ${data.father_religion}</p>
                                <p><strong>Contact:</strong> ${data.contact_number}</p>
                                <p><strong>Address:</strong> ${data.address}</p>
                                <p><strong>Sponsor (Female):</strong> ${data.sponsor_female}</p>
                                <p><strong>Sponsor (Male):</strong> ${data.sponsor_male}</p>
                                <p><strong>Child Birth Certificate:</strong></p>
                                <img src="/storage/${data.child_birthcert}" alt="Child Birth Certificate" class="w-full mt-2 rounded">
                            `;
                                }

                                // Check for Burial Data
                                if (data.name_deceased) {
                                    eventDetailsHtml += `
                                <p><strong>Deceased Name:</strong> ${data.name_deceased}</p>
                                <p><strong>Cause of Death:</strong> ${data.cause_of_death}</p>
                                <p><strong>Place of Burial:</strong> ${data.place_of_burial}</p>
                                <p><strong>Date of Burial:</strong> ${data.date_burial}</p>
                                <p><strong>Date of Death:</strong> ${data.date_death}</p>
                                <p><strong>Death Certificate:</strong></p>
                                <img src="/storage/${data.cert_death}" alt="Death Certificate" class="w-full mt-2 rounded">
                            `;
                                }

                                eventDetailsHtml += '</div>'; // Close the space-y-2 div
                                modalContent.innerHTML = eventDetailsHtml;
                            }
                        })
                        .catch(error => {
                            modalContent.innerHTML =
                                `<p class="text-red-500">An error occurred while fetching data.</p>`;
                        });
                });
            });

            // Close the modal
            closeModal.addEventListener('click', function() {
                detailsModal.classList.add('hidden');
                detailsModal.classList.remove('flex');
            });

            closeModalBtn.addEventListener('click', function() {
                detailsModal.classList.add('hidden');
                detailsModal.classList.remove('flex');
            });
        });
    </script>

</x-app-layout>
