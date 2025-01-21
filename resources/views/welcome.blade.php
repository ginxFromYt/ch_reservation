<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Church Reservation System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css' rel='stylesheet' />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js'></script>

    <script src="{{ asset('js/jqueary.js') }}"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            background-image: url('{{ asset('images/church.jpg') }}');
            background-size: cover;
            background-attachment: fixed;
            background-position: center;
        }

        nav {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 50;
        }

        main {
            padding-top: 5rem;
            /* Adjust to prevent overlap with fixed navbar */
        }

        /* .baptism-count-label {
            position: absolute;
            bottom: 2px;
            left: 2px;
            background-color: green;
            color: white;
            padding: 2px 5px;
            font-size: 10px;
            border-radius: 5px;
        } */
    </style>
</head>

<body class="bg-gray-100">

    <!-- Navbar -->
    <nav class="bg-white shadow-md">
        <div class="container mx-auto px-4 py-4 flex flex-wrap justify-between items-center">
            <div class="text-xl font-bold text-blue-600">Church Reservation System</div>
            <div class="flex space-x-4 mt-2 sm:mt-0">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ route('dashboard') }}"
                            class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-500 text-sm md:text-base">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}"
                            class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-500 text-sm md:text-base">Login</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-500 text-sm md:text-base">Sign
                                Up</a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </nav>
    <!-- Main Content -->
    <main>
        <!-- Hero Section -->
        <section class="py-20 text-center">
            <div class="container mx-auto px-4">
                <h1 class="text-3xl md:text-5xl font-bold mb-6 text-white"
                    style="text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.9);">
                    Welcome to the Church Reservation System
                </h1>
                <p class="mb-6 text-base md:text-lg text-white" style="text-shadow: 1px 1px 3px rgba(0, 0, 0, 1);">
                    Plan your visit and reserve your spot for upcoming services at your local church.
                </p>
                <a href="#reservation"
                    class="inline-block px-6 py-3 bg-blue-600 text-white font-semibold rounded hover:bg-blue-700"
                    data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    Reserve Now
                </a>
            </div>
        </section>

        <!-- Features Section -->
        <section id="features" class="py-20 bg-gray-100">
            <div class="container mx-auto px-4 text-center">
                <h2 class="text-2xl md:text-3xl font-bold mb-12">Features</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                    <div class="bg-white p-4 rounded shadow-md">
                        <img src="{{ asset('images/booking.png') }}" alt="Feature 1" class="mx-auto mb-4 w-16 h-16">
                        <h3 class="text-lg font-bold mb-2">Easy Reservations</h3>
                        <p class="text-sm md:text-base">Book your seat online easily and avoid crowding in the church.
                        </p>
                    </div>
                    <div class="bg-white p-4 rounded shadow-md">
                        <img src="{{ asset('images/real-time.png') }}" alt="Feature 2" class="mx-auto mb-4 w-16 h-16">
                        <h3 class="text-lg font-bold mb-2">Real-time Updates</h3>
                        <p class="text-sm md:text-base">Stay updated with service timings and availability in real-time.
                        </p>
                    </div>
                    <div class="bg-white p-4 rounded shadow-md">
                        <img src="{{ asset('images/safety.png') }}" alt="Feature 3" class="mx-auto mb-4 w-16 h-16">
                        <h3 class="text-lg font-bold mb-2">Safe and Secure</h3>
                        <p class="text-sm md:text-base">Ensure safety by limiting attendees and maintaining social
                            distancing.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- How it Works Section -->
        <section id="how-it-works" class="py-20 bg-white">
            <div class="container mx-auto px-4 text-center">
                <h2 class="text-2xl md:text-3xl font-bold mb-12">How It Works</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                    <div class="p-6 bg-gray-100 rounded shadow-md">
                        <span class="text-blue-600 text-4xl font-bold">1</span>
                        <h3 class="text-lg font-bold my-2">Create an Account</h3>
                        <p class="text-sm md:text-base">Sign up with your email and create your profile.</p>
                    </div>
                    <div class="p-6 bg-gray-100 rounded shadow-md">
                        <span class="text-blue-600 text-4xl font-bold">2</span>
                        <h3 class="text-lg font-bold my-2">Choose a Service</h3>
                        <p class="text-sm md:text-base">Select the date and time of the service you want to attend.</p>
                    </div>
                    <div class="p-6 bg-gray-100 rounded shadow-md">
                        <span class="text-blue-600 text-4xl font-bold">3</span>
                        <h3 class="text-lg font-bold my-2">Reserve Your Seat</h3>
                        <p class="text-sm md:text-base">Confirm your reservation and receive a digital pass.</p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-6">
        <div class="container mx-auto text-center text-sm">
            <p>&copy; 2024 Church Reservation System. All rights reserved.</p>
        </div>
    </footer>



    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 font-bold" id="staticBackdropLabel">Before signing up for reservation,
                        please feel free to check the event calendar for your reference.</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="calendar" style="overflow-y: auto;"></div>
                </div>
                <div class="modal-footer">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ route('dashboard') }}"
                                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-500 text-sm md:text-base">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" type="button" class="btn btn-success">LOG
                                IN</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" type="button" class="btn btn-secondary">Sign Up to
                                    Reserve</a>
                            @endif
                        @endauth
                    @endif
                    {{-- <a href="{{ route('register') }}" type="button" class="btn btn-secondary">REGISTER</a>
                    <a href="{{ route('login') }}" type="button" class="btn btn-success">LOG
                        IN</a> --}}
                </div>
            </div>
        </div>

        @php
            // Fetch approved reservations with event details
            $approvedReservations = DB::table('reservations')
                ->join('events', 'reservations.event_id', '=', 'events.id')
                ->select(
                    'reservations.reservation_date',
                    'reservations.reservation_time',
                    'events.name',
                    'events.description',
                )
                ->where('reservations.status', 'approved')
                ->get();

            //dd($approvedReservations);

            use Carbon\Carbon;

            // Group Baptism events by date and count occurrences
            $baptismCounts = [];

            $events = $approvedReservations->map(function ($reservation) use (&$baptismCounts) {
                // Combine date and time to a proper DateTime object
                $dateTime = Carbon::createFromFormat(
                    'Y-m-d h:i A',
                    $reservation->reservation_date . ' ' . $reservation->reservation_time,
                );

                // Add to baptism count for the date
                if ($reservation->name === 'Baptism') {
                    $dateOnly = $dateTime->format('Y-m-d'); // Format as 'YYYY-MM-DD' for grouping
                    if (!isset($baptismCounts[$dateOnly])) {
                        $baptismCounts[$dateOnly] = 0;
                    }
                    $baptismCounts[$dateOnly]++;
                }

                return [
                    'title' => $reservation->name,
                    'start' => $dateTime->toIso8601String(),
                    'description' => $reservation->description,
                    'date' => $dateTime->format('Y-m-d'), // Add date to event for easier grouping
                ];
            });

            // dd($events);

        @endphp

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var calendarEl = document.getElementById('calendar');

                // Events passed from PHP
                var events = @json($events);

                // Baptism count per date passed from PHP
                var baptismCounts = @json($baptismCounts);

                // Create a dictionary to track reservations per date
                var reservationCounts = {};

                // Count reservations for each date and event type
                events.forEach(function(event) {
                    var eventDate = event.start.split('T')[0]; // Extract date (YYYY-MM-DD)
                    if (!reservationCounts[eventDate]) {
                        reservationCounts[eventDate] = {
                            Baptism: 0,
                            Wedding: 0,
                            Burial: 0
                        };
                    }

                    if (event.title === "Baptism") {
                        reservationCounts[eventDate].Baptism++;
                    } else if (event.title === "Wedding Ceremony") {
                        reservationCounts[eventDate].Wedding++;
                    } else if (event.title === "Burial Mass") {
                        reservationCounts[eventDate].Burial++;
                    }
                });

                // Initialize FullCalendar
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    timeZone: 'Asia/Manila', // Adjust as needed
                    events: events,
                    eventClick: function(info) {
                        alert('Event: ' + info.event.title + '\nDescription: ' + info.event.extendedProps
                            .description);
                    },
                    eventDidMount: function(info) {
                        // Apply custom colors based on event title
                        switch (info.event.title) {
                            case 'Baptism':
                                info.el.style.backgroundColor = 'green';
                                info.el.style.color = 'white'; // Adjust text color for contrast
                                break;
                            case 'Wedding Ceremony':
                                info.el.style.backgroundColor = 'yellow';
                                info.el.style.color = 'black'; // Adjust text color for contrast
                                break;
                            case 'Burial Mass':
                                info.el.style.backgroundColor = 'blue';
                                info.el.style.color = 'white'; // Adjust text color for contrast
                                break;
                            default:
                                // No custom styling for other events
                                break;
                        }
                    },
                    datesSet: function(info) {
                        // Highlight dates as fully booked based on reservation counts
                        var dateCells = calendarEl.querySelectorAll('.fc-daygrid-day');
                        dateCells.forEach(function(cell) {
                            var date = cell.getAttribute('data-date');
                            if (reservationCounts[date]) {
                                var count = reservationCounts[date];

                                // If fully booked for weddings
                                if (count.Wedding >= 2) {
                                    cell.style.backgroundColor = 'red'; // Mark as fully booked
                                    var fullyBookedLabel = document.createElement('div');
                                    fullyBookedLabel.innerText = "Fully Booked (Wedding)";
                                    fullyBookedLabel.style.color = 'white';
                                    fullyBookedLabel.style.fontSize = '12px';
                                    cell.appendChild(fullyBookedLabel);
                                }

                                // If fully booked for burials
                                if (count.Burial >= 6) {
                                    cell.style.backgroundColor = 'red'; // Mark as fully booked
                                    var fullyBookedLabel = document.createElement('div');
                                    fullyBookedLabel.innerText = "Fully Booked (Burial)";
                                    fullyBookedLabel.style.color = 'white';
                                    fullyBookedLabel.style.fontSize = '12px';
                                    cell.appendChild(fullyBookedLabel);
                                }
                            }
                        });
                    },
                });

                $('#staticBackdrop').on('shown.bs.modal', function() {
                    calendar.render();
                });
            });
        </script>
    </div>
</body>

</html>
