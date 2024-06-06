<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CustomerBookingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('/auth.login');
});



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/logout', [App\Http\Controllers\HomeController::class, 'logout'])->name('logout');

Route::get('/earnings-data', [App\Http\Controllers\EarningsController::class, 'getEarningsData'])->name('earnings.data');

Route::resource('services', ServiceController::class);

Route::middleware(['auth', 'role:Customer'])->group(function () {
    Route::get('customer/bookings', [CustomerBookingController::class, 'index'])->name('customer.bookings.index');
    Route::get('customer/bookings/create', [CustomerBookingController::class, 'create'])->name('customer.bookings.create');
    Route::post('customer/bookings', [CustomerBookingController::class, 'store'])->name('customer.bookings.store');
    Route::get('customer/bookings/{id}/edit', [CustomerBookingController::class, 'edit'])->name('customer.bookings.edit');
    Route::put('customer/bookings/{id}', [CustomerBookingController::class, 'update'])->name('customer.bookings.update');
    Route::delete('customer/bookings/{id}', [CustomerBookingController::class, 'destroy'])->name('customer.bookings.destroy');
    Route::get('customer/bookings/{id}/receipt', [CustomerBookingController::class, 'showReceipt'])->name('customer.bookings.receipt');
    Route::get('downloadReceipt/{id}', [CustomerBookingController::class, 'downloadReceipt'])->name('downloadReceipt');
    Route::get('customer/bookings/unavailable-slots', [CustomerBookingController::class, 'getUnavailableSlots']);

    // route alur baru
    Route::get('customer/booking/step1', [CustomerBookingController::class, 'step1'])->name('customer.booking.step1');
    Route::post('customer/booking/step1', [CustomerBookingController::class, 'postStep1'])->name('customer.booking.step1.post');

    Route::get('customer/booking/step2', [CustomerBookingController::class, 'step2'])->name('customer.booking.step2');
    Route::post('customer/booking/step2', [CustomerBookingController::class, 'postStep2'])->name('customer.booking.step2.post');

    Route::get('customer/booking/step3', [CustomerBookingController::class, 'step3'])->name('customer.booking.step3');
    Route::post('customer/booking/step3', [CustomerBookingController::class, 'postStep3'])->name('customer.booking.step3.post');

    Route::get('customer/booking/confirm', [CustomerBookingController::class, 'confirm'])->name('customer.booking.confirm');
    Route::post('customer/booking/confirm', [CustomerBookingController::class, 'store'])->name('customer.booking.store');
});



Route::middleware(['auth', 'role:Admin|Barber'])->group(function () {
    Route::get('bookingAdmin', [CustomerBookingController::class, 'showBooking'])->name('bookingAdmin.index');
    Route::get('bookingAdmin/{id}/edit', [CustomerBookingController::class, 'editBooking'])->name('bookingAdmin.edit');
    Route::put('/bookingAdmin/{id}', [CustomerBookingController::class, 'updateBooking'])->name('bookingAdmin.update');
    Route::delete('bookingAdmin/{id}', [CustomerBookingController::class, 'destroyBooking'])->name('bookingAdmin.destroy');
});


Route::middleware(['auth', 'role:Admin'])->group(function () {
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);
    Route::resource('users', UserController::class);
});

Route::get('admin', function () {
    return '<h1>Hello Admin</h1>';
})->middleware(['auth', 'verified', 'role:Admin']);

Route::get('barber', function () {
    return '<h1>Hello Barber</h1>';
})->middleware(['auth', 'verified', 'role:Barber|Admin']);
