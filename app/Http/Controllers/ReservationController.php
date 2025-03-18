<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Room;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ReservationController extends Controller
{
    /**
     * Menampilkan daftar reservasi user
     */
    public function index()
    {
        $reservations = Reservation::where('user_id', Auth::id())->with('room')->paginate(10);
        return view('user.reservations.index', compact('reservations'));
    }

    /**
     * Formulir pemesanan kamar
     */
    public function create()
    {
        $rooms = Room::all();
        return view('user.reservations.create', compact('rooms'));
    }

    /**
     * Menyimpan pemesanan baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'check_in_date' => 'required|date|after_or_equal:today',
            'check_out_date' => 'required|date|after:check_in_date',
            'total_rooms' => 'required|integer|min:1',
        ]);

        Reservation::create([
            'reservation_id' => Str::uuid(),
            'user_id' => Auth::id(),
            'room_id' => $request->room_id,
            'check_in_date' => $request->check_in_date,
            'check_out_date' => $request->check_out_date,
            'total_rooms' => $request->total_rooms,
            'status' => 'pending', 
        ]);

        return redirect()->route('user.reservations.index')->with('success', 'Pemesanan berhasil dibuat!');
    }

    /**
     * Menampilkan detail pemesanan
     */
    public function show($id)
    {
        $reservation = Reservation::where('user_id', Auth::id())->with('room')->findOrFail($id);
        return view('user.reservations.show', compact('reservation'));
    }

    public function update(Request $request, $id)
    {
        $reservation = Reservation::where('user_id', Auth::id())->findOrFail($id);

        $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled',
        ]);

        $reservation->update(['status' => $request->status]);

        return redirect()->route('user.reservations.dashboard')->with('success', 'Status pemesanan diperbarui.');
    }

    public function destroy($id)
    {
        $reservation = Reservation::where('user_id', Auth::id())->where('status', 'pending')->findOrFail($id);
        $reservation->delete();

        return redirect()->route('user.reservations.index')->with('success', 'Pemesanan berhasil dibatalkan.');
    }
}
