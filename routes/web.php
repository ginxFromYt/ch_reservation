<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Models\Role;
use App\Models\RoleUser;

use App\Http\Controllers\testcont;
use PHPUnit\Event\Code\Test;


Route::get('/', function () {
    return view('welcome');
});



//route for dedicated dashboard for every user
Route::get('/dashboard', function () {

    if (Auth::user()->roles[0]->name == "Admin") {
        return view('admin.dashboard');
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
Route::namespace('App\Http\Controllers\User')->prefix('user')->as('user.')->group(function () {
        Route::get('/reservation', 'UserController@viewReservation')->name('reservation');
        Route::get('/bookreservation', 'UserController@bookReservation')->name('bookreservation');
        Route::post('/proceedreservation', 'UserController@proceedReservation')->name('proceedreservation');
    });


require __DIR__ . '/auth.php';
