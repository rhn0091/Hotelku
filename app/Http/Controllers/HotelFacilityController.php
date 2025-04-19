<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HotelFacility;
use Illuminate\Support\Str;

class HotelFacilityController extends Controller
{
    // Buat user lihat semua fasilitas
    public function index()
    {
        $facilities = HotelFacility::all();
        return view('user.hotel_facilities.index', compact('facilities'));
    }

    // Admin lihat semua fasilitas
    public function adminIndex()
    {
        $facilities = HotelFacility::all();
        return view('admin.hotel_facilities.index', compact('facilities'));
    }

    public function create()
    {
        return view('admin.hotel_facilities.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'facility_name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        HotelFacility::create([
            'id' => Str::uuid(),
            'facility_name' => $request->facility_name,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.hotel_facilities.index')->with('success', 'Fasilitas berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $facility = HotelFacility::findOrFail($id);
        return view('admin.hotel_facilities.edit', compact('facility'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'facility_name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $facility = HotelFacility::findOrFail($id);
        $facility->update($request->only('facility_name', 'description'));

        return redirect()->route('admin.hotel_facilities.index')->with('success', 'Fasilitas berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $facility = HotelFacility::findOrFail($id);
        $facility->delete();

        return redirect()->route('admin.hotel_facilities.index')->with('success', 'Fasilitas berhasil dihapus!');
    }
}
