<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HotelFacility;
use Illuminate\Support\Str;

class HotelFacilityController extends Controller
{
    public function index()
    {
        return response()->json(HotelFacility::all());
    }

    public function store(Request $request)
    {
        $request->validate(['facility_name' => 'required|string', 'description' => 'nullable|string']);
        return response()->json(HotelFacility::create(['id' => Str::uuid()] + $request->all()), 201);
    }

    public function destroy($id)
    {
        HotelFacility::findOrFail($id)->delete();
        return response()->json(['message' => 'Hotel facility deleted']);
    }
}



// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use App\Models\HotelFacility;
// use Illuminate\Support\Str;

// class HotelFacilityController extends Controller
// {
//     public function index()
//     {
//         return response()->json(HotelFacility::all());
//     }

//     public function store(Request $request)
//     {
//         $request->validate([
//             'facility_name' => 'required|string|max:255',
//             'description' => 'nullable|string',
//         ]);

//         $facility = HotelFacility::create([
//             'id' => Str::uuid(),
//             'facility_name' => $request->facility_name,
//             'description' => $request->description,
//         ]);

//         return response()->json(['message' => 'Facility created', 'data' => $facility], 201);
//     }

//     public function show($id)
//     {
//         return response()->json(HotelFacility::findOrFail($id));
//     }

//     public function update(Request $request, $id)
//     {
//         $facility = HotelFacility::findOrFail($id);
//         $facility->update($request->only(['facility_name', 'description']));

//         return response()->json(['message' => 'Facility updated', 'data' => $facility]);
//     }

//     public function destroy($id)
//     {
//         HotelFacility::findOrFail($id)->delete();
//         return response()->json(['message' => 'Facility deleted']);
//     }
// }
