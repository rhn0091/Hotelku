<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RoomFacility;

class RoomFacilityController extends Controller
{
    public function store(Request $request)
    {
        $request->validate(['rooms_id' => 'required', 'facility_name' => 'required|string']);
        return response()->json(RoomFacility::create($request->all()), 201);
    }

    public function destroy($id)
    {
        RoomFacility::findOrFail($id)->delete();
        return response()->json(['message' => 'Facility deleted']);
    }
}
