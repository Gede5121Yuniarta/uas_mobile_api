<?php

namespace App\Http\Controllers;

use App\Models\Kost;
use App\Models\Property;
use App\Models\Room;
use Illuminate\Http\Request;

class DetailController extends Controller
{
    // public function show(Property $property)
    // {
    //     return view('detail', compact('property'));
    // }
    // public function show()
    // {
    //     return view('detail');
    // }
    // public function show($id)
    // {
    //     $kost = Kost::findOrFail($id);
    //     return view('detail', compact('kost'));
    // }

    // public function show($slug)
    // {
    //     $kost = Kost::where('slug', $slug)->firstOrFail();
    //     $mediaFiles = json_decode($kost->media, true);
    //     return view('detail', compact('kost', 'mediaFiles'));
    // }

    public function show($slug)
    {
        $kost = Kost::where('slug', $slug)->firstOrFail();
        $mediaFiles = json_decode($kost->media, true);
        $rooms = Room::where('kost_id', $kost->id)->get(); // Mengambil daftar kamar yang terkait dengan kost

        return view('detail', compact('kost', 'mediaFiles', 'rooms'));
    }

    public function showRoom($slug)
    {
        // Mengambil data room berdasarkan slug
        $room = Room::where('slug', $slug)->firstOrFail();
        // Mengambil data kost terkait
        $kost = Kost::findOrFail($room->kost_id);
        // Mengambil media files untuk room
        $mediaFiles = json_decode($room->rooms_media, true);

        return view('rooms.detail', compact('room', 'kost', 'mediaFiles'));
    }
}
