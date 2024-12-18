<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Church Reservation System</title>
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
                <p class="mb-6 text-base md:text-lg text-white"
                    style="text-shadow: 1px 1px 3px rgba(0, 0, 0, 1);">
                    Plan your visit and reserve your spot for upcoming services at your local church.
                </p>
                <a href="#reservation"
                    class="inline-block px-6 py-3 bg-blue-600 text-white font-semibold rounded hover:bg-blue-700">
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
                        <img src="{{ asset('images/booking.png') }}" alt="Feature 1"
                            class="mx-auto mb-4 w-16 h-16">
                        <h3 class="text-lg font-bold mb-2">Easy Reservations</h3>
                        <p class="text-sm md:text-base">Book your seat online easily and avoid crowding in the church.</p>
                    </div>
                    <div class="bg-white p-4 rounded shadow-md">
                        <img src="{{ asset('images/real-time.png') }}" alt="Feature 2"
                            class="mx-auto mb-4 w-16 h-16">
                        <h3 class="text-lg font-bold mb-2">Real-time Updates</h3>
                        <p class="text-sm md:text-base">Stay updated with service timings and availability in real-time.</p>
                    </div>
                    <div class="bg-white p-4 rounded shadow-md">
                        <img src="{{ asset('images/safety.png') }}" alt="Feature 3"
                            class="mx-auto mb-4 w-16 h-16">
                        <h3 class="text-lg font-bold mb-2">Safe and Secure</h3>
                        <p class="text-sm md:text-base">Ensure safety by limiting attendees and maintaining social distancing.</p>
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

</body>

</html>
