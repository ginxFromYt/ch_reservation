<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Reservations;
use Carbon\Carbon;

class UpdateReservationStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reservations:update-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $currentDateTime = Carbon::now();

        $reservations = Reservations::where('status', 'pending')
            ->orWhere('status', 'approved')
            ->get();

        foreach ($reservations as $reservation) {
            // Combine reservation date and time into a Carbon instance
            $reservationDateTime = Carbon::createFromFormat(
                'Y-m-d h:i A',
                $reservation->reservation_date . ' ' . $reservation->reservation_time
            );

            // Check if the reservation is in the past
            if ($reservationDateTime->isBefore($currentDateTime)) {
                // Set status to 'lapsed' if it is in the past
                $reservation->status = 'lapsed/finished';
                $reservation->save();
            }

            // Optionally, add conditions for 'finished' status here
            // For example, after a specific time window has passed
        }

        $this->info('Reservation statuses updated!');
    }
}
