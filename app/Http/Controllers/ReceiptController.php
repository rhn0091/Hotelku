<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Receipt;
use Illuminate\Support\Str;
use App\Mail\SendReceiptQr;
use Illuminate\Support\Facades\Mail;

class ReceiptController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'reservation_id' => 'required|exists:reservations,reservation_id',
            'receipt_code' => 'required|unique:receipts,receipt_code',
        ]);

        $receipt = Receipt::create([
            'id' => Str::uuid(),
            'reservation_id' => $request->reservation_id,
            'receipt_code' => $request->receipt_code,
        ]);

        $qrUrl = route('scan.qr.confirm', $receipt->id);
        Mail::to($receipt->reservation->user->email)->send(new SendReceiptQr($receipt, $receipt->reservation));

        return response()->json($receipt, 201);
    }

    public function confirmScan($receiptId)
    {
        $receipt = Receipt::with('reservation')->findOrFail($receiptId);

        $receipt->reservation->update(['status' => 'confirmed']);

        return redirect()->route('scan.success')->with([
            'receipt_code' => $receipt->receipt_code,
            'reservation_id' => $receipt->reservation->reservation_id
        ]);
    }
}