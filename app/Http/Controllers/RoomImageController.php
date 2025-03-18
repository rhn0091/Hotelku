<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RoomImage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class RoomImageController extends Controller
{
    public function index()
    {
        $roomImages = RoomImage::all();
        return response()->json($roomImages);
    }

    public function store(Request $request)
    {
        $request->validate([
            'rooms_id' => 'required|exists:rooms,rooms_id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imagePath = $request->file('image')->store('room_images', 'public');

        $roomImage = RoomImage::create([
            'rooms_id' => $request->rooms_id,
            'image_path' => $imagePath,
        ]);

        return response()->json($roomImage, 201);
    }

    public function show($id)
    {
        $roomImage = RoomImage::findOrFail($id);
        return response()->json($roomImage);
    }

    public function destroy($id)
    {
        $roomImage = RoomImage::findOrFail($id);
        Storage::disk('public')->delete($roomImage->image_path);
        $roomImage->delete();
        return response()->json(['message' => 'Room image deleted successfully']);
    }
}