<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ReceptionistController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Auth;


Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminController::class, 'login']);
    Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');
    Route::get('/dashboard', [RoomController::class, 'adminIndex'])
        ->middleware('auth:admin')
        ->name('admin.dashboard');
});

Route::prefix('receptionist')->group(function () {
    Route::get('/login', [ReceptionistController::class, 'showLoginForm'])->name('receptionist.login');
    Route::post('/login', [ReceptionistController::class, 'login']);
    Route::post('/logout', [ReceptionistController::class, 'logout'])->name('receptionist.logout');
    Route::get('/dashboard', function () {
        return view('receptionists.dashboard');
    })->middleware('auth:receptionist')->name('receptionists.dashboard');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/reservations', [ReservationController::class, 'index'])->name('user.reservations.index');
    Route::get('/reservations/create', [ReservationController::class, 'create'])->name('user.reservations.create');
    Route::post('/reservations', [ReservationController::class, 'store'])->name('user.reservations.store');
    Route::get('/reservations/{id}', [ReservationController::class, 'show'])->name('user.reservations.show');
    Route::put('/reservations/{id}', [ReservationController::class, 'update'])->name('user.reservations.update');
    Route::delete('/reservations/{id}', [ReservationController::class, 'destroy'])->name('user.reservations.destroy');
});


// ✅ Untuk User
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('index');
Route::get('/rooms', [RoomController::class, 'index'])->name('user.index');
Route::get('/rooms/{id}', [RoomController::class, 'show'])->name('user.show');

// ✅ Untuk Admin
Route::prefix('admin')->group(function () {
    // Route::get('/admin/dashboard', [RoomController::class, 'adminIndex'])->name('admin.dashboard');
    Route::get('/rooms/create', [RoomController::class, 'create'])->name('admin.create_room');
    Route::post('/rooms', [RoomController::class, 'store'])->name('admin.store_room');
    Route::get('/rooms/{id}/edit', [RoomController::class, 'edit'])->name('admin.edit_room');
    Route::put('/rooms/{id}', [RoomController::class, 'update'])->name('admin.update_room');
    Route::delete('/rooms/{id}', [RoomController::class, 'destroy'])->name('admin.destroy_room');
});


Route::get('/', function () {
    return view('awalan');
});

Auth::routes();


