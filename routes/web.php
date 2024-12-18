<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

use App\Models\Role;
use App\Models\RoleUser;
use Carbon\Carbon;

use App\Http\Controllers\testcont;
use PHPUnit\Event\Code\Test;


Route::get('/', function () {
    return view('welcome');
});



//route for dedicated dashboard for every user
Route::get('/dashboard', function () {

    if (Auth::user()->roles[0]->name == "Admin") {
        $reservations = DB::table('reservations')
            ->whereIn('status', ['approved', 'lapsed/finished', 'pending']) // Include pending, approved, and lapsed/finished
            ->get();

        $events = DB::table('events')
            ->whereNotIn('name', ['Sunday Mass', 'Christmas Eve Mass']) // Exclude irrelevant events
            ->get();

        // Initialize counts for each event and status
        $eventStatusCounts = [];
        foreach ($events as $event) {
            $eventStatusCounts[$event->id] = [
                'approved' => 0,
                'lapsed/finished' => 0,
                'pending' => 0,
            ];
        }

        // Populate counts based on reservations
        foreach ($reservations as $reservation) {
            $eventId = $reservation->event_id;
            $status = $reservation->status;

            if (isset($eventStatusCounts[$eventId]) && isset($eventStatusCounts[$eventId][$status])) {
                $eventStatusCounts[$eventId][$status]++;
            }
        }

        $eventLabels = $events->pluck('name'); // Event names for labels

        // Join users and roles tables
        $users = DB::table('users')
            ->join('role_users', 'users.id', '=', 'role_users.user_id')
            ->join('roles', 'role_users.role_id', '=', 'roles.id')
            ->select('users.*', 'roles.role')
            ->get();

        $totalReservations = $reservations->count();
        $statusCounts = $reservations->groupBy('status')->map->count();
        $eventCounts = $reservations->groupBy('event_id')->map->count();

        $totalUsers = $users->where('role', 'user')->count();
        $totalVerifiedUsers = $users->where('role', 'user')->whereNotNull('email_verified_at')->count();
        $totalUnverifiedUsers = $users->where('role', 'user')->whereNull('email_verified_at')->count();

        // Return all data to the view
        return view('admin.dashboard', compact(
            'reservations',
            'events',
            'eventStatusCounts',
            'eventLabels',
            'users',
            'totalReservations',
            'statusCounts',
            'eventCounts',
            'totalUsers',
            'totalVerifiedUsers',
            'totalUnverifiedUsers'
        ));
    } else if (Auth::user()->roles[0]->name == "User") {


        return view('user.dashboard');
    } else {
        return view('dashboard');
    }
})->middleware(['auth', 'verified'])->name('dashboard');




// route for profile edit and email reset
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// routes for users only
// Grouping routes under the 'user' prefix and User namespace
Route::
        namespace('App\Http\Controllers\User')->prefix('user')->as('user.')->group(function () {
            Route::get('/viewApproved', 'UserController@viewApproved')->name('viewApproved');
            Route::get('/viewPending', 'UserController@viewPending')->name('viewPending');
            Route::get('/bookreservation', 'UserController@bookReservation')->name('bookreservation');
            Route::post('/proceedreservation', 'UserController@proceedReservation')->name('proceedreservation');
            Route::get('/fetchreservation', 'UserController@fetch')->name('fetchreservation');
        });


// for admin routes
Route::
        namespace('App\Http\Controllers\Admin')->prefix('admin')->as('admin.')->group(function () {
            Route::get('/AprovedReservation', 'AdminController@AprovedReservation')->name('AprovedReservation');
            Route::get('/PendingReservation', 'AdminController@PendingReservation')->name('PendingReservation');
            Route::get('/LapsedReservation', 'AdminController@LapsedReservation')->name('LapsedReservation');
            Route::get('/approve/{id}', 'AdminController@approveReservation')->name('approve');
            Route::get('/reject/{id}', 'AdminController@rejectReservation')->name('reject');
            Route::get('/view-pending-details/{id}', 'AdminController@ViewPendingDetails')->name('ViewPendingDetails');


        });


require __DIR__ . '/auth.php';
