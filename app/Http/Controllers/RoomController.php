<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RoomImage;
use App\Models\Room;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::latest()->paginate(5)->withQueryString();
        return view('user.index', compact('rooms'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function adminIndex()
    {
        $rooms = Room::select('rooms_id', 'room_type', DB::raw('SUM(total_room) as total_room'))
            ->groupBy('rooms_id', 'room_type')
            ->get();

        return view('admin.dashboard', compact('rooms'));
    }


    public function create()
    {
        return view('admin.create_room');
    }

    public function store(Request $request)
    {
        $request->validate([
            'room_type' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'total_room' => 'required|integer|min:1',
            'capacity' => 'required|integer|min:1',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $room = Room::create([
            'rooms_id' => \Illuminate\Support\Str::uuid(), // Pastikan UUID dibuat
            'room_type' => $request->room_type,
            'price' => $request->price,
            'total_room' => $request->total_room,
            'capacity' => $request->capacity,
            'description' => $request->description,
            'image' => $request->file('image') ? $request->file('image')->store('room_images', 'public') : null,
        ]);

        // Simpan gambar jika ada yang diunggah
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePath = $image->store('rooms', 'public');

                RoomImage::create([
                    'rooms_id' => $room->rooms_id, // Pastikan sesuai dengan primary key Room
                    'image_path' => $imagePath,
                ]);
            }
        }

        return redirect()->route('admin.create_room')->with('success', 'Room created successfully!');
    }

    public function show($id)
    {
        $room = Room::with(['facilities', 'images'])->findOrFail($id);
        return view('user.show', compact('room'));
    }

    public function Adminshow($id)
    {
        $room = Room::with(['facilities', 'images'])->findOrFail($id);
        return view('admin.show', compact('room'));
    }


    public function edit($id)
    {
        $room = Room::findOrFail($id);
        return view('admin.edit_room', compact('room'));
    }

    public function update(Request $request, $id)
    {
        $room = Room::findOrFail($id);
        $room->update($request->only(['room_type', 'price', 'capacity', 'description', 'image']));
        return redirect()->route('admin.dashboard')->with('success', 'Room updated successfully!');
    }

    public function destroy($reservation_id)
{
    DB::beginTransaction();
    try {
        $reservation = Reservation::where('user_id', Auth::id())
            ->where('status', 'pending')
            ->where('reservation_id', $reservation_id)
            ->firstOrFail();

        $room = Room::where('rooms_id', $reservation->rooms_id)->first();
        if ($room) {
            $room->increment('total_room', $reservation->total_rooms);
        }

        $reservation->delete();
        
        DB::commit();

        return redirect()->route('user.reservations.index')
            ->with('success', 'Pemesanan berhasil dibatalkan dan stok kamar dikembalikan.');

    } catch (\Exception $e) {
        DB::rollBack();
        return redirect()->back()
            ->with('error', 'Gagal membatalkan pemesanan: ' . $e->getMessage());
    }
}
}


// namespace App\Http\Controllers;

// use App\Models\RoomImage;
// use Illuminate\Http\Request;
// use App\Models\Room;
// use Illuminate\Support\Str;

// class RoomController extends Controller
// {

//     public function index()
//     {
//         $rooms = Room::latest()->paginate(5)->withQueryString();
//         return view('user.index', compact('rooms'))->with('i', (request()->input('page', 1) - 1) * 5);
//     }

//     public function adminIndex()
//     {
//         $rooms = Room::latest()->paginate(5)->withQueryString();
//         return view('admin.dashboard', compact('rooms'))->with('i', (request()->input('page', 1) - 1) * 5);
//     }

//     public function create()
//     {
//         return view('admin.create_room');
//     }

//     public function store(Request $request)
//     {
//         $request->validate([
//             'room_type' => 'required|string|max:255',
//             'price' => 'required|numeric',
//             'capacity' => 'required|integer',
//             'description' => 'nullable|string',
//             'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', 
//         ]);

//         $room = Room::create([
//             'id' => Str::uuid(),
//             'room_type' => $request->room_type,
//             'price' => $request->price,
//             'capacity' => $request->capacity,
//             'description' => $request->description,
//         ]);

//         if ($request->hasFile('images')) {
//             foreach ($request->file('images') as $image) {
//                 $imagePath = $image->store('rooms', 'public');

//                 RoomImage::create([
//                     'room_id' => $room->id,
//                     'image_path' => $imagePath,
//                 ]);
//             }
//         }

//         return redirect()->route('admin.create_room')->with('success', 'Room created successfully!');
//     }
//     public function show($id)
//     {
//         $room = Room::with('images')->findOrFail($id);
//         return view('user.show', compact('room'));
//     }


//     public function edit($id)
//     {
//         $room = Room::findOrFail($id);
//         return view('admin.edit_room', compact('room'));
//     }

//     public function update(Request $request, $id)
//     {
//         $room = Room::findOrFail($id);
//         $room->update($request->only(['room_type', 'price', 'capacity', 'description', 'image']));

//         return redirect()->route('admin.dashboard')->with('success', 'Room updated successfully!');
//     }

//     public function destroy($id)
//     {
//         Room::findOrFail($id)->delete();
//         return redirect()->route('admin.dashboard')->with('success', 'Room deleted successfully!');
//     }
// } 
