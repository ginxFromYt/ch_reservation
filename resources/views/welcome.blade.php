<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Church Reservation System</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <!-- Navbar -->
    <nav class="bg-white shadow-md">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <div class="text-xl font-bold text-blue-600">Church Reservation System</div>
            <div class="flex space-x-6">
                @if (Route::has('login'))
                    @auth
                        <a href="#" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-500">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-500">Login</a>
                        @if (Route::has('register'))
                            <a href="{{ route('login') }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-500">Sign Up</a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="bg-blue-600 text-white py-20">
        <div class="container mx-auto text-center">
            <h1 class="text-4xl font-bold mb-6">Welcome to the Church Reservation System</h1>
            <p class="mb-6 text-lg">Plan your visit and reserve your spot for upcoming services at your local church.
            </p>
            <a href="#reservation"
                class="px-6 py-3 bg-white text-blue-600 font-semibold rounded hover:bg-gray-200">Reserve Now</a>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-20">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold mb-12">Features</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-6 rounded shadow-md">
                    <img src="https://via.placeholder.com/100" alt="Feature 1" class="mx-auto mb-4">
                    <h3 class="text-xl font-bold mb-2">Easy Reservations</h3>
                    <p>Book your seat online easily and avoid crowding in the church.</p>
                </div>
                <div class="bg-white p-6 rounded shadow-md">
                    <img src="https://via.placeholder.com/100" alt="Feature 2" class="mx-auto mb-4">
                    <h3 class="text-xl font-bold mb-2">Real-time Updates</h3>
                    <p>Stay updated with service timings and availability in real-time.</p>
                </div>
                <div class="bg-white p-6 rounded shadow-md">
                    <img src="https://via.placeholder.com/100" alt="Feature 3" class="mx-auto mb-4">
                    <h3 class="text-xl font-bold mb-2">Safe and Secure</h3>
                    <p>Ensure safety by limiting the number of attendees and maintaining social distancing.</p>
                </div>

            </div>
        </div>
    </section>

    <!-- How it Works Section -->
    <section id="how-it-works" class="bg-gray-50 py-20">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold mb-12">How It Works</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-6 rounded shadow-md">
                    <span class="text-blue-600 text-4xl font-bold">1</span>
                    <h3 class="text-xl font-bold mb-2">Create an Account</h3>
                    <p>Sign up with your email and create your profile. Please use a valid legitimate email.</p>
                </div>
                <div class="bg-white p-6 rounded shadow-md">
                    <span class="text-blue-600 text-4xl font-bold">2</span>
                    <h3 class="text-xl font-bold mb-2">Choose a Service</h3>
                    <p>Select the date and time of the service you want to attend.</p>
                </div>
                <div class="bg-white p-6 rounded shadow-md">
                    <span class="text-blue-600 text-4xl font-bold">3</span>
                    <h3 class="text-xl font-bold mb-2">Reserve Your Seat</h3>
                    <p>Confirm your reservation and get a digital pass for the service. The system will notify you once the chosen date and time for the reservation is available.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    {{-- <section id="contact" class="py-20">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold mb-12">Contact Us</h2>
            <form class="bg-white p-8 rounded shadow-md max-w-lg mx-auto">
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name</label>
                    <input type="text" id="name" class="w-full px-4 py-2 border rounded"
                        placeholder="Your Name">
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                    <input type="email" id="email" class="w-full px-4 py-2 border rounded"
                        placeholder="Your Email">
                </div>
                <div class="mb-4">
                    <label for="message" class="block text-gray-700 text-sm font-bold mb-2">Message</label>
                    <textarea id="message" class="w-full px-4 py-2 border rounded" rows="4" placeholder="Your Message"></textarea>
                </div>
                <button type="submit" class="px-6 py-3 bg-blue-600 text-white rounded hover:bg-blue-500">Send
                    Message</button>
            </form>
        </div>
    </section> --}}

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-6">
        <div class="container mx-auto text-center">
            <p>&copy; 2024 Church Reservation System. All rights reserved.</p>
        </div>
    </footer>

</body>

</html>
