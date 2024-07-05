<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Kost;
use App\Models\RoomClass;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class RoomController extends Controller
{

    public function index()
    {
        $adminId = Auth::id();
        $rooms = Room::whereHas('kost', function ($query) use ($adminId) {
            $query->where('owner_id', $adminId);
        })->with('kost', 'roomClass')->latest()->paginate(10);

        return view('rooms.index', compact('rooms'));
    }

    public function create()
    {
        $user = Auth::user();
        $kosts = Kost::where('status', 'confirm')->where('owner_id', $user->id)->get();
        $roomClasses = RoomClass::where('owner_id', $user->id)->get();

        return view('rooms.create', compact('kosts', 'roomClasses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kost_id' => 'required|exists:kosts,id',
            'class_id' => 'required|exists:room_classes,id',
            'rooms_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'rooms_media' => 'nullable|array',
            'jumlah_kamar' => 'required|integer',
        ]);

        $uploadedMedia = [];

        if ($request->hasFile('rooms_media')) {
            $files = $request->file('rooms_media');

            foreach ($files as $file) {
                $extension = $file->getClientOriginalExtension();
                $allowedExtensions = ['jpeg', 'png', 'jpg', 'gif', 'webp', 'mov', 'mp4', 'avi'];

                if (!in_array($extension, $allowedExtensions)) {
                    return redirect()->back()->withErrors(['rooms_media' => 'Invalid file format. Only images and videos allowed.']);
                }

                $imageName = time() . '_' . uniqid() . '.' . $extension;
                $file->move(public_path('images/kamar'), $imageName);
                $uploadedMedia[] = 'images/kamar/' . $imageName;
            }
        }

        $user = Auth::user();
        $room = new Room($request->except('rooms_media'));
        $room->rooms_media = json_encode($uploadedMedia);
        $room->owner_id = $user->id; // Set owner_id sesuai user yang login
        $room->save();

        return redirect()->route('rooms.index')->with('success', 'Room created successfully.');
    }

    public function show($slug)
    {
        $room = Room::where('slug', $slug)->firstOrFail();
        $kost = Kost::findOrFail($room->kost_id);
        $mediaFiles = explode(',', $room->rooms_media);

        return view('rooms.detail', compact('room', 'kost', 'mediaFiles'));
    }

    public function showRoom($slug)
    {
        $room = Room::where('slug', $slug)->firstOrFail();
        $kost = Kost::findOrFail($room->kost_id);
        $mediaFiles = json_decode($room->rooms_media, true);
        $otherAvailableRooms = Room::where('kost_id', $kost->id)
            ->where('status', 'Tersedia')
            ->where('id', '!=', $room->id)
            ->get();

        if (request()->ajax()) {
            return response()->json([
                'room' => $room,
                'kost' => $kost,
                'mediaFiles' => array_map(function ($media) {
                    return asset($media);
                }, $mediaFiles),
                'otherAvailableRooms' => $otherAvailableRooms
            ]);
        }

        return view('rooms.detail', compact('room', 'kost', 'mediaFiles', 'otherAvailableRooms'));
    }

    public function edit(Room $room)
    {

        $user = Auth::user();
        $kosts = Kost::where('status', 'confirm')->where('owner_id', $user->id)->get();
        $roomClasses = RoomClass::where('owner_id', $user->id)->get();

        return view('rooms.edit', compact('room', 'kosts', 'roomClasses'));
    }

    public function update(Request $request, Room $room)
    {
        $request->validate([
            'kost_id' => 'required|exists:kosts,id',
            'class_id' => 'required|exists:room_classes,id',
            'rooms_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'rooms_media' => 'nullable|array',
            'jumlah_kamar' => 'required|integer',
        ]);

        $uploadedMedia = [];

        if ($request->hasFile('rooms_media')) {
            $files = $request->file('rooms_media');

            foreach ($files as $file) {
                $extension = $file->getClientOriginalExtension();
                $allowedExtensions = ['jpeg', 'png', 'jpg', 'gif', 'webp', 'mov', 'mp4', 'avi'];

                if (!in_array($extension, $allowedExtensions)) {
                    return redirect()->back()->withErrors(['rooms_media' => 'Invalid file format. Only images and videos allowed.']);
                }

                $imageName = time() . '_' . uniqid() . '.' . $extension;
                $file->move(public_path('images/kamar'), $imageName);
                $uploadedMedia[] = 'images/kamar/' . $imageName;
            }
        }

        $room->fill($request->except('rooms_media'));

        if (!empty($uploadedMedia)) {
            $room->rooms_media = implode(',', $uploadedMedia);
        }

        $room->save();

        return redirect()->route('rooms.index')->with('success', 'Room updated successfully.');
    }

    public function destroy(Room $room)
    {
        $room->delete();
        return redirect()->route('rooms.index')->with('success', 'Room deleted successfully.');
    }

    public function updateStatus(Request $request, $id)
    {
        $room = Room::findOrFail($id);
        $room->update(['status' => $request->status]);

        return redirect()->route('rooms.index')->with('success', 'Status updated successfully.');
    }

    public function updateJumlahKamar(Request $request, Room $room)
    {
        $request->validate([
            'jumlah_kamar' => 'required|integer',
        ]);

        $room->jumlah_kamar = $request->input('jumlah_kamar');
        $room->save();

        return redirect()->route('rooms.index')->with('success', 'Jumlah kamar diperbarui.');
    }
}
