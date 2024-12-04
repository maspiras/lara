<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Rooms\RoomsController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\Services\ServiceController;
use App\Http\Controllers\ResponseCalendarController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Reports\SalesReportController;
use App\Http\Controllers\Reports\ReservationsReportController;
use App\Http\Controllers\Reports\PaymentsReportController;
use App\Http\Controllers\Refunds\RefundController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('employees', UserController::class);
    Route::resource('rooms', RoomsController::class);
    Route::resource('reservations', ReservationController::class);
    Route::patch('reservations/{id}/payment', [ReservationController::class, 'makePayment'])->name('reservation.makePayment');
    Route::resource('refunds', RefundController::class);
    Route::resource('services', ServiceController::class);
    Route::resource('calendar', CalendarController::class);


    ######### Reports ########
    Route::group(['prefix' => 'reports'], function () {
        Route::get('/', [SalesReportController::class, 'index'])->name('reports.sales.index');
        Route::get('/sales', [SalesReportController::class, 'index'])->name('reports.sales.index');
        Route::get('/sales/daily', [SalesReportController::class, 'getDaily'])->name('reports.sales.daily');
        Route::get('/sales/monthly', [SalesReportController::class, 'getMonthly'])->name('reports.sales.monthly');
        Route::get('/reservations', [ReservationsReportController::class, 'index'])->name('reports.reservations.index');
        Route::get('/payments', [PaymentsReportController::class, 'index'])->name('reports.payments.index');
        

    });
    

    Route::resource('responsecalendar/3c2df05e/remote', ResponseCalendarController::class);    
    Route::get('/responsecalendar/3c2df05e/error',[ResponseCalendarController::class, 'errorting'])->name('reservations.errorting');
    Route::get('/responsecalendar/3c2df05e/log',[ResponseCalendarController::class, 'log'])->name('reservations.log');
});


require __DIR__.'/auth.php';
