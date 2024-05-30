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

// Route::get('bookings/create', [BookingController::class, 'create'])->name('bookings.create');
// Route::post('bookings', [BookingController::class, 'store'])->name('bookings.store');
// Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
// Route::resource('bookings', BookingController::class);

Route::resource('services', ServiceController::class);

Route::middleware(['auth', 'role:Customer|Admin'])->group(function () {
    Route::get('customer/bookings', [CustomerBookingController::class, 'index'])->name('customer.bookings.index');
    Route::get('customer/bookings/create', [CustomerBookingController::class, 'create'])->name('customer.bookings.create');
    Route::post('customer/bookings', [CustomerBookingController::class, 'store'])->name('customer.bookings.store');
    Route::get('customer/bookings/{id}/edit', [CustomerBookingController::class, 'edit'])->name('customer.bookings.edit');
    Route::put('customer/bookings/{id}', [CustomerBookingController::class, 'update'])->name('customer.bookings.update');
    Route::delete('customer/bookings/{id}', [CustomerBookingController::class, 'destroy'])->name('customer.bookings.destroy');
    Route::get('customer/bookings/{id}/receipt', [CustomerBookingController::class, 'showReceipt'])->name('customer.bookings.receipt');
    Route::get('downloadReceipt/{id}', [CustomerBookingController::class, 'downloadReceipt'])->name('downloadReceipt');
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
