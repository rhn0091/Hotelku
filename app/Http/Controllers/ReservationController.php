<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Room;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\Receipt;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendReceiptQr;

class ReservationController extends Controller
{
    public function index()
    {
        // Cek dan update semua reservasi yang sudah lewat tanggal check_out
        Reservation::where('user_id', Auth::id())
            ->where('status', 'confirmed')
            ->whereDate('check_out_date', '<', now()->toDateString())
            ->update(['status' => 'checked_out']);

        // Ambil semua reservasi milik user saat ini (termasuk yang sudah checked_out)
        $reservations = Reservation::where('user_id', Auth::id())
            ->with('room')
            ->orderBy('check_in_date', 'desc')
            ->paginate(10);

        return view('user.reservations.index', compact('reservations'));
    }


    public function create()
    {
        $rooms = Room::all();
        return view('user.reservations.create', compact('rooms'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'rooms_id' => 'required|exists:rooms,rooms_id',
            'check_in_date' => 'required|date|after_or_equal:today',
            'check_out_date' => 'required|date|after:check_in_date',
            'total_rooms' => 'required|integer|min:1',
        ]);

        $room = Room::where('rooms_id', $request->rooms_id)->firstOrFail();

        if ($room->total_room < $request->total_rooms) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Jumlah kamar tidak mencukupi. Stok tersisa: ' . $room->total_room);
        }

        $reservation = null;
        $receipt = null;

        DB::transaction(function () use ($request, $room, &$reservation, &$receipt) {
            $reservation = Reservation::create([
                'reservation_id' => Str::uuid(),
                'user_id' => Auth::id(),
                'rooms_id' => $request->rooms_id,
                'check_in_date' => $request->check_in_date,
                'check_out_date' => $request->check_out_date,
                'total_rooms' => $request->total_rooms,
                'status' => 'pending',
            ]);

            // Kurangi stok kamar
            $room->decrement('total_room', $request->total_rooms);

            // Buat receipt
            $receipt = Receipt::create([
                'id' => Str::uuid(),
                'reservation_id' => $reservation->reservation_id,
                'receipt_code' => 'RCPT-' . strtoupper(Str::random(10)),
            ]);
        });

        if (!$receipt) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat membuat receipt. Silakan coba lagi.');
        }

        $qrUrl = route('scan.qr.confirm', $receipt->id);

        Mail::to(Auth::user()->email)->send(new SendReceiptQr($receipt, $qrUrl));

        if (!$reservation) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat membuat reservasi. Silakan coba lagi.');
        }

        return redirect()->route('user.reservations.show', $reservation->reservation_id)
            ->with('success', 'Pemesanan berhasil dibuat. QR Code sudah dikirim ke email kamu.')
            ->with('qr_url', $qrUrl);
    }

    public function show($reservation_id)
    {
        $reservation = Reservation::with('room')->findOrFail($reservation_id);
        $receipt = Receipt::where('reservation_id', $reservation_id)->first();

        $qr_url = route('scan.qr.confirm', $receipt->id);

        return view('user.reservations.show', compact('reservation', 'receipt', 'qr_url'));
    }


    public function update(Request $request, $reservation_id)
    {
        $reservation = Reservation::where('user_id', Auth::id())
            ->where('reservation_id', $reservation_id)
            ->firstOrFail();

        $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled,checked_out',
        ]);

        $reservation->update(['status' => $request->status]);

        return redirect()->route('user.reservations.index')->with('success', 'Status pemesanan diperbarui.');
    }

    public function destroy($reservation_id)
    {
        $reservation = Reservation::where('user_id', Auth::id())
            ->where('status', 'pending')
            ->where('reservation_id', $reservation_id)
            ->firstOrFail();

        $room = Room::where('rooms_id', $reservation->rooms_id)->first();
        if ($room) {
            $room->increment('total_room', $reservation->total_rooms);
        }

        $reservation->delete();

        return redirect()->route('user.reservations.index')->with('success', 'Pemesanan berhasil dibatalkan.');
    }

    public function history()
    {
        $reservations = Reservation::where('user_id', Auth::id())
            ->whereIn('status', ['cancelled', 'checked_out'])
            ->with('room')
            ->orderBy('check_out_date', 'desc')
            ->paginate(10);

        return view('user.reservations.history', compact('reservations'));
    }


    // 🆕 Tambahan: Scan QR -> ubah status jadi "confirmed"
    // public function confirmViaQr($receiptId)
    // {
    //     $receipt = Receipt::with('reservation')->findOrFail($receiptId);
    //     $reservation = $receipt->reservation;

    //     if ($reservation->status === 'pending') {
    //         $reservation->update(['status' => 'confirmed']);
    //         return response()->json(['message' => 'Reservasi berhasil dikonfirmasi.']);
    //     }

    //     return response()->json(['message' => 'Reservasi sudah dikonfirmasi sebelumnya.']);
    // }
}