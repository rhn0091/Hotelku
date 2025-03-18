<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Receipt;
use App\Models\Reservation;
use Illuminate\Support\Str;

class ReceiptController extends Controller
{
    public function index()
    {
        $receipts = Receipt::all();
        return response()->json($receipts);
    }

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

        return response()->json($receipt, 201);
    }

    public function show($id)
    {
        $receipt = Receipt::findOrFail($id);
        return response()->json($receipt);
    }

    public function destroy($id)
    {
        $receipt = Receipt::findOrFail($id);
        $receipt->delete();
        return response()->json(['message' => 'Receipt deleted successfully']);
    }
}

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use App\Models\Receipt;
// use Illuminate\Support\Str;

// class ReceiptController extends Controller
// {
//     public function index()
//     {
//         return response()->json(Receipt::all());
//     }

//     public function store(Request $request)
//     {
//         $request->validate([
//             'reservation_id' => 'required|exists:reservations,id',
//             'receipt_code' => 'required|string|max:255|unique:receipts,receipt_code',
//         ]);

//         $receipt = Receipt::create([
//             'id' => Str::uuid(),
//             'reservation_id' => $request->reservation_id,
//             'receipt_code' => $request->receipt_code,
//         ]);

//         return response()->json(['message' => 'Receipt created', 'data' => $receipt], 201);
//     }

//     public function show($id)
//     {
//         return response()->json(Receipt::findOrFail($id));
//     }

//     public function update(Request $request, $id)
//     {
//         $receipt = Receipt::findOrFail($id);
//         $receipt->update($request->only(['reservation_id', 'receipt_code']));

//         return response()->json(['message' => 'Receipt updated', 'data' => $receipt]);
//     }

//     public function destroy($id)
//     {
//         Receipt::findOrFail($id)->delete();
//         return response()->json(['message' => 'Receipt deleted']);
//     }
// }
