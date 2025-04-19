<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservation;


class ReceptionistController extends Controller
{
    //login
    public function showLoginForm()
    {
        return view('receptionists.login-receptionists');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $receptionist = \App\Models\receptionist::where('email', $request->email)->first();

        if ($receptionist && $receptionist->password === $request->password) {
            Auth::guard('receptionist')->login($receptionist);
            return redirect()->route('receptionist.dashboard');
        }

        return back()->withErrors(['email' => 'Email atau password salah']);
    }

    public function logout()
    {
        Auth::guard('receptionist')->logout();
        return redirect()->route('receptionist.login');
    }

    //fitur

    public function viewReservations(Request $request)
{
    $search = $request->input('search'); // Nama tamu
    $checkInDate = $request->input('check_in_date'); // Filter tanggal

    // Query dasar
    $query = Reservation::with(['user', 'room']);

    // Pencarian berdasarkan nama tamu
    if ($search) {
        $query->whereHas('user', function ($q) use ($search) {
            $q->where('name', 'LIKE', '%' . $search . '%');
        });
    }

    // Filter berdasarkan tanggal check-in
    if ($checkInDate) {
        $query->whereDate('check_in_date', $checkInDate);
    }

    $reservations = $query->orderBy('check_in_date', 'desc')->paginate(10);

    return view('receptionists.dashboard', compact('reservations', 'search', 'checkInDate'));
}
}
