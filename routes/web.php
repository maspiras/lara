<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Rooms\RoomsController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ResponseCalendarController;
use App\Http\Controllers\CalendarController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    //return view('dashboard');
    return view('default.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('rooms', RoomsController::class);
    Route::resource('reservations', ReservationController::class);
    Route::resource('calendar', CalendarController::class);
    Route::resource('reports', CalendarController::class);
    //Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');

    Route::resource('responsecalendar/3c2df05e/remote', ResponseCalendarController::class);    
    Route::get('/responsecalendar/3c2df05e/error',[ResponseCalendarController::class, 'errorting'])->name('reservations.errorting');
    Route::get('/responsecalendar/3c2df05e/log',[ResponseCalendarController::class, 'log'])->name('reservations.log');
});

/* Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('products', ProductController::class);
}); */

require __DIR__.'/auth.php';
