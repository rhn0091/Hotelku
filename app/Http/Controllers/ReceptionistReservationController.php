<?php

namespace App\Http\Controllers\Receptionist;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservation;
use Illuminate\Support\Facades\DB;

class ReceptionistReservationController extends Controller
{
    public function index(Request $request)
    {
        // Ambil query parameter
        $search = $request->input('search'); // Nama tamu
        $checkInDate = $request->input('check_in_date'); // Tanggal check-in

        // Query dasar
        $query = Reservation::with('user', 'room');

        // Filter berdasarkan nama tamu (relasi user)
        if ($search) {
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'LIKE', '%' . $search . '%');
            });
        }

        // Filter berdasarkan tanggal check-in
        if ($checkInDate) {
            $query->whereDate('check_in_date', $checkInDate);
        }

        // Ambil data terbaru duluan
        $reservations = $query->orderBy('check_in_date', 'desc')->paginate(10);

        return view('receptionist.reservations.index', compact('reservations', 'search', 'checkInDate'));
    }
}
