<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\BurialDetails;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Events;
use App\Models\BaptismDetail;
use App\Models\WeddingDetail;
use App\Models\Reservations;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function viewReservation()
    {
        return view('user.myreservation');
    }

    public function bookReservation()
    {

        $events = Events::all();

        return view('user.bookreservation')
            ->with('events', $events);
    }

    public function proceedReservation(Request $request)
    {
        // dd($request);
        // Check if the user already has a reservation for the selected event
        $reservationExists = Reservations::where('user_id', Auth::id())
            ->where('event_id', $request->event_id)
            ->exists();

        if ($reservationExists) {
            return redirect()->back()->with('error', 'You already have a reservation for this event.');
        }

        // Handle event-specific logic
        if ($request->event_id == 3) {
            // Baptism Event
            $baptismDetail = BaptismDetail::create([
                'user_id' => Auth::id(),
                'event_id' => $request->event_id,
                'child_name' => $request->child_name,
                'child_bday' => $request->child_birthday,
                'mother_name' => $request->mother_name,
                'mother_bday' => $request->mother_birthday,
                'father_name' => $request->father_name,
                'father_bday' => $request->father_birthday,
                'sponsor_female' => $request->sponsor_female,
                'sponsor_male' => $request->sponsor_male,
            ]);

            // If baptism details are successfully created, create the reservation
            if ($baptismDetail) {
                $reservation = Reservations::create([
                    'user_id' => Auth::id(),
                    'event_id' => $request->event_id,
                    'reservation_date' => $request->reservation_date,
                    'reservation_time' => $request->reservation_time,
                    'number_of_people' => $request->number_of_people,
                    'status' => 'pending',
                ]);

                // Link baptism detail to reservation
                $baptismDetail->update(['reservation_id' => $reservation->id]);
            }
        } else if ($request->event_id == 2) {
            // Wedding Event
            if ($request->hasFile('marriage_license')) {
                // Store the file in the 'uploads' directory inside 'public'
                $filePath = $request->file('marriage_license')->store('uploads', 'public');

                // Create the WeddingDetail record
                $weddingDetail = WeddingDetail::create([
                    'user_id' => Auth::id(),
                    'event_id' => $request->event_id,
                    'bride_name' => $request->bride_name,
                    'groom_name' => $request->groom_name,
                    'marriage_file' => $filePath,
                    'wedding_participants' => $request->number_of_people,
                    'wedding_notes' => $request->wedding_notes,
                ]);

                if ($weddingDetail) {
                    $reservation = Reservations::create([
                        'user_id' => Auth::id(),
                        'event_id' => $request->event_id,
                        'reservation_date' => $request->reservation_date,
                        'reservation_time' => $request->reservation_time,
                        'number_of_people' => $request->number_of_people,
                        'status' => 'pending',
                    ]);

                    // Link wedding detail to reservation
                    $weddingDetail->update(['reservation_id' => $reservation->id]);
                }
            } else {
                return redirect()->back()->with('error', 'Marriage license file is required.');
            }
        } else if ($request->event_id == 5) {
            // Burial Event
            $burialDetail = BurialDetails::create([
                'user_id' => Auth::id(),
                'event_id' => $request->event_id,
                'name_deceased' => $request->name_deceased,
                'date_death' => $request->date_death,
                'time_death' => $request->time_death,
                'contact_person' => $request->contact_person,
                'relationship' => $request->relationship,
                'contact_number' => $request->contact_number,
                'email' => $request->email,
            ]);

            if ($burialDetail) {
                $reservation = Reservations::create([
                    'user_id' => Auth::id(),
                    'event_id' => $request->event_id,
                    'reservation_date' => $request->reservation_date,
                    'reservation_time' => $request->reservation_time,
                    'number_of_people' => $request->number_of_people,
                    'status' => 'pending',
                ]);

                // Link burial detail to reservation
                $burialDetail->update(['reservation_id' => $reservation->id]);
            }
        }

        return redirect()->back()->with('success', 'Reservation created successfully!');
    }


}
