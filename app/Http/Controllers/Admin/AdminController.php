<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Models\Reservations;
use App\Models\BaptismDetail;
use App\Models\WeddingDetail;
use App\Models\BurialDetails;
use App\Models\Events;

class AdminController extends Controller
{


    /**
     * Display a listing of the resource.
     */
    public function PendingReservation()
    {

        $reservations = Reservations::where('status', 'pending')
            ->join('users', 'reservations.user_id', '=', 'users.id')
            ->join('events', 'reservations.event_id', '=', 'events.id')
            ->select(
                'reservations.*',
                'users.name as user_name',
                'users.email as user_email',
                'events.name as event_name'
            )
            ->get();

        // dd($reservations);

        return view("admin.pending_reservation")->with('reservations', $reservations);
    }

    /**
     * Display a listing of the resource.
     */
    public function AprovedReservation()
    {

        $reservations = Reservations::where('status', 'approved')
            ->join('users', 'reservations.user_id', '=', 'users.id')
            ->join('events', 'reservations.event_id', '=', 'events.id')
            ->select(
                'reservations.*',
                'users.name as user_name',
                'users.email as user_email',
                'events.name as event_name'
            )
            ->get();

        return view("admin.aproved_reservation")->with('reservations', $reservations);
    }

    /**
     * Approve a reservation
     */
    public function approveReservation($id)
    {
        $reservation = Reservations::find($id);
        $reservation->status = 'approved';
        $reservation->save();

        return redirect()->route('admin.PendingReservation');
    }

    public function ViewPendingDetails($id)
    {
        // Fetch the reservation details
        $reservationDetails = Reservations::where('event_id', $id)->first();

        if (!$reservationDetails) {
            return response()->json(['error' => 'Reservation not found.'], 404);
        }

        // Fetch event details from related tables
        $eventDetails = [];
        if ($baptism = BaptismDetail::where('event_id', $id)->first()) {
            $eventDetails = $baptism;
        } elseif ($wedding = WeddingDetail::where('event_id', $id)->first()) {
            $eventDetails = $wedding;
        } elseif ($burial = BurialDetails::where('event_id', $id)->first()) {
            $eventDetails = $burial;
        } else {
            return response()->json(['error' => 'No event details found.'], 404);
        }

        // Merge the data as one array
        $mergedData = array_merge($reservationDetails->toArray(), $eventDetails->toArray());

        // Return as JSON response
        return response()->json($mergedData);
    }

}
