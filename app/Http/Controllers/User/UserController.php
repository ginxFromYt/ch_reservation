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
use Illuminate\Support\Facades\Storage;


class UserController extends Controller
{
    public function viewApproved()
    {

        $reservations = Reservations::where('user_id', Auth::id())
            ->join('users', 'reservations.user_id', '=', 'users.id')
            ->where('reservations.status', 'Approved')
            ->get();
        //  dd($reservations);
        return view('user.myapprovedreservation')->with('reservations', $reservations);
    }

    public function viewPending()
    {

        $reservations = Reservations::where('user_id', Auth::id())
            ->join('users', 'reservations.user_id', '=', 'users.id')
            ->where('reservations.status', 'Pending')
            ->get();
        //  dd($reservations);
        return view('user.mypendingreservation')->with('reservations', $reservations);
    }

    public function bookReservation()
    {

        $events = Events::all();

        return view('user.bookreservation')
            ->with('events', $events);
    }

    public function proceedReservation(Request $request)
    {
        // Check if the user already has a reservation for the selected event
        $reservationExists = Reservations::where('user_id', Auth::id())
            ->where('event_id', $request->event_id)
            ->exists();

        if ($reservationExists) {
            return redirect()->back()->with('error', 'You already have a reservation for this event.');
        }

        // Check if there is an existing reservation with the same date and time where the status is approved
        $conflictingReservation = Reservations::where('reservation_date', $request->reservation_date)
            ->where('reservation_time', $request->reservation_time)
            ->where('status', 'approved')
            ->exists();

        if ($conflictingReservation) {
            return redirect()->back()->with('error', 'There is already an approved reservation for the selected date and time.');
        }

        // Handle event-specific logic
        if ($request->event_id == 2) { // Event id 2 is wedding
            // Rules: 1 AM and 1 PM per day (max 2 reservations)
            $weddingCountAM = Reservations::where('event_id', 2)
                ->where('reservation_date', $request->reservation_date)
                ->where('reservation_time', '9:30 AM')
                ->count();

            $weddingCountPM = Reservations::where('event_id', 2)
                ->where('reservation_date', $request->reservation_date)
                ->where('reservation_time', '2:00 PM')
                ->count();

            if (
                ($request->reservation_time == '9:30 AM' && $weddingCountAM >= 1) ||
                ($request->reservation_time == '2:00 OM' && $weddingCountPM >= 1)
            ) {
                return redirect()->back()->with('error', 'The wedding reservation limit for this time slot has been reached.');
            }

            if (!$request->hasFile('marriage_file')) {
                return redirect()->back()->with('error', 'Marriage license file is required.');
            }

            $filePath = $request->file('marriage_file')->store('marriage_file', 'public');

            $weddingDetail = WeddingDetail::create([
                'user_id' => Auth::id(),
                'event_id' => $request->event_id,
                'bride_name' => $request->bride_name,
                'groom_name' => $request->groom_name,
                'groom_birth_date' => $request->groom_birthdate,
                'groom_age' => $request->groom_age,
                'groom_birth_place' => $request->groom_birthplace,
                'groom_address' => $request->groom_address,
                'groom_father_name' => $request->groom_father,
                'groom_mother_name' => $request->groom_mother,
                'groom_job' => $request->groom_job,
                'groom_religion' => $request->groom_religion,
                'bride_birth_date' => $request->bride_birthdate,
                'bride_age' => $request->bride_age,
                'bride_birth_place' => $request->bride_birthplace,
                'bride_address' => $request->bride_address,
                'bride_father_name' => $request->bride_father,
                'bride_mother_name' => $request->bride_mother,
                'bride_job' => $request->bride_job,
                'bride_religion' => $request->bride_religion,
                'sponsor_ninong1' => $request->sponsor_ninong1,
                'sponsor_ninang1' => $request->sponsor_ninang1,
                'sponsor_ninong2' => $request->sponsor_ninong2,
                'sponsor_ninang2' => $request->sponsor_ninang2,
                'marriage_file' => $filePath,
            ]);

            if ($weddingDetail) {
                $reservation = Reservations::create([
                    'user_id' => Auth::id(),
                    'event_id' => $request->event_id,
                    'reservation_date' => $request->reservation_date,
                    'reservation_time' => $request->reservation_time,
                    'status' => 'pending',
                ]);
                $weddingDetail->update(['reservation_id' => $reservation->id]);
            }

            return redirect()->back()->with('success', 'Wedding reservation created successfully!');
        } else if ($request->event_id == 5) { // Event id 5 is burial
            // Rules: Max 3 AM (8:00) and 3 PM (14:00)
            $burialCountAM = Reservations::where('event_id', 5)
                ->where('reservation_date', $request->reservation_date)
                ->where('reservation_time', '08:00 AM')
                ->count();

            $burialCountPM = Reservations::where('event_id', 5)
                ->where('reservation_date', $request->reservation_date)
                ->where('reservation_time', '2:00 PM')
                ->count();

            if (
                ($request->reservation_time == '08:00 AM' && $burialCountAM >= 3) ||
                ($request->reservation_time == '2:00 PM' && $burialCountPM >= 3)
            ) {
                return redirect()->back()->with('error', 'The burial reservation limit for this time slot has been reached.');
            }

            $certDeathPath = null;
            if ($request->hasFile('cert_death') && $request->file('cert_death')->isValid()) {
                $certDeathPath = $request->file('cert_death')->store('death_certs', 'public');
            }

            $burialDetail = BurialDetails::create([
                'user_id' => Auth::id(),
                'event_id' => $request->event_id,
                'name_deceased' => $request->name_deceased,
                'date_birth' => $request->date_birth,
                'date_death' => $request->date_death,
                'time_death' => $request->time_death,
                'age' => $request->age_deceased,
                'civil_status' => $request->civil_status,
                'cause_of_death' => $request->cause_death,
                'place_of_burial' => $request->place_burial,
                'date_burial' => $request->reservation_date,
                'time_burial' => $request->time_burial,
                'cert_death' => $certDeathPath,
                'contact_person' => $request->contact_person,
                'relationship' => $request->relationship,
                'contact_number' => $request->contact_number,
            ]);

            if ($burialDetail) {
                $reservation = Reservations::create([
                    'user_id' => Auth::id(),
                    'event_id' => $request->event_id,
                    'reservation_date' => $request->reservation_date,
                    'reservation_time' => $request->reservation_time,
                    'status' => 'pending',
                ]);
                $burialDetail->update(['reservation_id' => $reservation->id]);
            }

            return redirect()->back()->with('success', 'Burial reservation created successfully!');
        } else if ($request->event_id == 3) { // Event id 3 is baptism
            $birthcertPath = null;

            // Handle file upload for birth certificate
            if ($request->hasFile('child_birthcert') && $request->file('child_birthcert')->isValid()) {
                $birthcertPath = $request->file('child_birthcert')->store('child_birthcerts', 'public');
            }

            $baptismDetail = BaptismDetail::create([
                'user_id' => Auth::id(),
                'event_id' => $request->event_id,
                //add reservation reservation_id
                'child_name' => $request->child_name,
                'child_bday' => $request->child_birthday,
                'child_birthcert' => $birthcertPath,
                'child_birthplace' => $request->child_birthplace,
                'mother_name' => $request->mother_name,
                'mother_bday' => $request->mother_birthday,
                'mother_birthplace' => $request->mother_birthplace,
                'mother_religion' => $request->mother_religion,
                'father_name' => $request->father_name,
                'father_bday' => $request->father_birthday,
                'father_birthplace' => $request->father_birthplace,
                'father_religion' => $request->father_religion,
                'address' => $request->address,
                'contact_number' => $request->contact_number,
                'sponsor_female' => $request->sponsor_female,
                'sponsor_male' => $request->sponsor_male,
            ]);

            if ($baptismDetail) {
                $reservation = Reservations::create([
                    'user_id' => Auth::id(),
                    'event_id' => $request->event_id,
                    'reservation_date' => $request->reservation_date,
                    'reservation_time' => $request->reservation_time,

                    // 'number_of_people' => $request->number_of_people,
                    'status' => 'pending',
                ]);

                $baptismDetail->update(['reservation_id' => $reservation->id]);
            }

            return redirect()->back()->with('success', 'Baptism reservation created successfully!');
        }

    }

    public function fetch()
    {
        $allreservations = Reservations::with(['event', 'baptismDetails', 'burialDetails', 'weddingDetails'])
            ->where('status', 'approved') // Filter reservations with status 'approved'
            ->get();
        return response()->json($allreservations); // Return data as JSON
    }

}
