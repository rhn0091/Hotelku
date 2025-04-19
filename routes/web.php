<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ReceptionistController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\RoomFacilityController;
use App\Http\Controllers\ReceiptController;
use App\Http\Controllers\HotelFacilityController;

Route::get('/scan-success', function () {
    return view('user.reservations.scan_success');
})->name('scan.success');

Route::get('/qr/confirm/{id}', [ReceiptController::class, 'confirmScan'])->name('scan.qr.confirm');
Route::get('/room-facility/{id}', [RoomFacilityController::class, 'show'])->name('user.show');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/rooms/facilities', [RoomFacilityController::class, 'adminIndex'])->name('admin.room_facility.index');
    Route::get('/admin/rooms/facilities/create', [RoomFacilityController::class, 'create'])->name('admin.room_facility.create');
    Route::post('/admin/rooms/facilities/store', [RoomFacilityController::class, 'store'])->name('room.room_facility.store');
    Route::put('/admin/rooms/facilities/{id}', [RoomFacilityController::class, 'update'])->name('admin.room_facility.update');
    Route::delete('/admin/rooms/facilities/{id}', [RoomFacilityController::class, 'destroy']);
});

Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminController::class, 'login']);
    Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');
    Route::get('/dashboard', [RoomController::class, 'adminIndex'])
        ->middleware('auth:admin')
        ->name('admin.dashboard');
});
Route::get('/hotel-facilities', [HotelFacilityController::class, 'index'])->name('user.hotel_facilities.index');

Route::middleware(['auth', 'admin'])->prefix('admin/hotel-facilities')->name('admin.hotel_facilities.')->group(function () {
    Route::get('/', [HotelFacilityController::class, 'adminIndex'])->name('index');
    Route::get('/create', [HotelFacilityController::class, 'create'])->name('create');
    Route::post('/', [HotelFacilityController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [HotelFacilityController::class, 'edit'])->name('edit');
    Route::put('/{id}', [HotelFacilityController::class, 'update'])->name('update');
    Route::delete('/{id}', [HotelFacilityController::class, 'destroy'])->name('destroy');
});

Route::prefix('receptionist')->group(function () {
    Route::get('/login', [ReceptionistController::class, 'showLoginForm'])->name('receptionist.login');
    Route::post('/login', [ReceptionistController::class, 'login']);
    Route::post('/logout', [ReceptionistController::class, 'logout'])->name('receptionist.logout');
    Route::get('/dashboard', [ReceptionistController::class, 'viewReservations'])
        ->middleware('auth:receptionist')
        ->name('receptionist.dashboard');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/reservations', [ReservationController::class, 'index'])->name('user.reservations.index');
    Route::get('/reservations/create', [ReservationController::class, 'create'])->name('user.reservations.create');
    Route::post('/reservations', [ReservationController::class, 'store'])->name('user.reservations.store');
    Route::get('/reservations/{id}', [ReservationController::class, 'show'])->name('user.reservations.show');
    Route::delete('/reservations/{id}', [ReservationController::class, 'destroy'])->name('user.reservations.destroy');
    Route::put('/reservations/{id}', [ReservationController::class, 'update'])->name('user.reservations.update');
    Route::get('/reservations/history', [ReservationController::class, 'history'])->name('user.reservations.history');
    // Route::delete('/admin/rooms/facilities/{id}', 'Admin\RoomFacilityController@destroy')->name('admin.room_facility.destroy');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('index');
Route::get('/rooms', [RoomController::class, 'index'])->name('user.index');
Route::get('/rooms/{id}', [RoomController::class, 'show'])->name('user.show');

Route::prefix('admin')->group(function () {
    Route::get('/rooms/create', [RoomController::class, 'create'])->name('admin.create_room');
    Route::post('/rooms', [RoomController::class, 'store'])->name('admin.store_room');
    Route::get('admin/rooms/{id}/edit', [RoomController::class, 'edit'])->name('admin.edit_room');
    Route::put('/rooms/{id}', [RoomController::class, 'update'])->name('admin.update_room');
    Route::get('/rooms/{id}', [RoomController::class, 'Adminshow'])->name('admin.show');
    Route::delete('/rooms/{id}', [RoomController::class, 'destroy'])->name('admin.destroy_room');
});


Route::get('/', function () {
    return view('awalan');
});



Auth::routes([
    'verify' => true,
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');
