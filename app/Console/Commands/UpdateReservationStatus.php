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

        // Get all reservations
        $reservations = Reservations::where('status', 'pending')
            ->get();

        foreach ($reservations as $reservation) {
            // Combine reservation date and time into a Carbon instance
            $reservationDateTime = Carbon::createFromFormat('Y-m-d h:i A', $reservation->reservation_date . ' ' . $reservation->reservation_time);

            // If the reservation is in the past, set it to 'lapsed'
            if ($reservationDateTime->isBefore($currentDateTime)) {
                $reservation->status = 'lapsed';
                $reservation->save();
            }
            // You can also add conditions to set the status to 'finished' if desired
            // For example, if you have a time window after the reservation, you can set it to finished after that time
        }

        $this->info('Reservation statuses updated!');
    }
}
