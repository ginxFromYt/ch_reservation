<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservations;

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
        ->select(  'reservations.*',
                            'users.name as user_name',
                            'users.email as user_email',
                            'events.name as event_name')
        ->get();

        // dd($reservations);

        return view("admin.pending_reservation")->with('reservations', $reservations);
    }

    /**
     * Display a listing of the resource.
     */
    public function AprovedReservation(){

            $reservations = Reservations::where('status', 'approved')
            ->join('users', 'reservations.user_id', '=', 'users.id')
            ->join('events', 'reservations.event_id', '=', 'events.id')
            ->select(  'reservations.*',
                                'users.name as user_name',
                                'users.email as user_email',
                                'events.name as event_name')
            ->get();

            return view("admin.aproved_reservation")->with('reservations', $reservations);
    }

    /**
     * Approve a reservation
     */
    public function approveReservation($id){
        $reservation = Reservations::find($id);
        $reservation->status = 'approved';
        $reservation->save();

        return redirect()->route('admin.PendingReservation');
    }
}
