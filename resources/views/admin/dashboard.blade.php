<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                <!-- Total Reservations Card -->
                <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6 text-center">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Total Reservations</h3>
                    <p class="text-3xl font-bold text-blue-600 mt-2">{{ $totalReservations }}</p>
                </div>

                <!-- User Summary Card -->
                <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6 text-center">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">User Summary</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">Logged In Users (Excluding Admins): <span
                            class="font-bold text-blue-600">{{ $totalUsers }}</span></p>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">Verified Users: <span
                            class="font-bold text-green-600">{{ $totalVerifiedUsers }}</span></p>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">Unverified Users: <span
                            class="font-bold text-red-600">{{ $totalUnverifiedUsers }}</span></p>
                </div>

                <!-- Status Distribution Pie Chart -->
                <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Reservation Status Distribution
                    </h3>
                    <canvas id="statusChart" class="w-full h-48"></canvas>
                </div>

                <!-- Event Reservations Bar Chart -->
                <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Reservations Per Event</h3>
                    <canvas id="upperEventChart" class="w-full h-48"></canvas>
                    <canvas id="lowerEventChart" class="w-full h-48 mt-6"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Data for Status Distribution Pie Chart
        const statusData = @json($statusCounts);
        const ctxStatus = document.getElementById('statusChart').getContext('2d');
        new Chart(ctxStatus, {
            type: 'pie',
            data: {
                labels: ['Approved', 'Lapsed/Finished', 'Pending'],
                datasets: [{
                    data: [
                        statusData.approved || 0,
                        statusData['lapsed/finished'] || 0,
                        statusData.pending || 0,
                    ],
                    backgroundColor: ['#36A2EB', '#FF6384', '#FFCE56'],
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    },
                },
            },
        });

        // Data for Reservations Per Event Charts
        const eventData = @json($eventStatusCounts);
        const eventLabels = @json($eventLabels);
        const approvedValues = Object.values(eventData).map(event => event.approved);
        const lapsedValues = Object.values(eventData).map(event => event['lapsed/finished']);
        const pendingValues = Object.values(eventData).map(event => event.pending);

        // Upper Bar Chart: Approved + Lapsed/Finished
        const ctxUpperEvent = document.getElementById('upperEventChart').getContext('2d');
        new Chart(ctxUpperEvent, {
            type: 'bar',
            data: {
                labels: eventLabels,
                datasets: [{
                    label: 'Approved & Lapsed/Finished',
                    data: approvedValues.map((val, i) => val + lapsedValues[i]),
                    backgroundColor: '#36A2EB',
                }],
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top'
                    },
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Events'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Number of Reservations'
                        },
                        beginAtZero: true
                    },
                },
            },
        });

        // Lower Bar Chart: Pending
        const ctxLowerEvent = document.getElementById('lowerEventChart').getContext('2d');
        new Chart(ctxLowerEvent, {
            type: 'bar',
            data: {
                labels: eventLabels,
                datasets: [{
                    label: 'Pending',
                    data: pendingValues,
                    backgroundColor: '#FFCE56',
                }],
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top'
                    },
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Events'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Number of Reservations'
                        },
                        beginAtZero: true
                    },
                },
            },
        });
    </script>
</x-app-layout>
