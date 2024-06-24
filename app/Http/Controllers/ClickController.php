<?php

// namespace App\Http\Controllers;

// use App\Models\Click;
// use Illuminate\Http\Request;

// class ClickController extends Controller
// {
//     /**
//      * Display a listing of the resource.
//      */
//     public function index()
//     {
//         //
//     }

//     /**
//      * Show the form for creating a new resource.
//      */
//     public function create()
//     {
//         //
//     }

//     /**
//      * Store a newly created resource in storage.
//      */
//     public function store(Request $request)
//     {
//         //
//     }

//     /**
//      * Display the specified resource.
//      */
//     public function show(Click $click)
//     {
//         //
//     }

//     /**
//      * Show the form for editing the specified resource.
//      */
//     public function edit(Click $click)
//     {
//         //
//     }

//     /**
//      * Update the specified resource in storage.
//      */
//     public function update(Request $request, Click $click)
//     {
//         //
//     }

//     /**
//      * Remove the specified resource from storage.
//      */
//     public function destroy(Click $click)
//     {
//         //
//     }
// }

//]]]]]]]]]]]]
namespace App\Http\Controllers;

use App\Models\Click;
use App\Models\Kost;
use App\Models\Room;
use Illuminate\Http\Request;

class ClickController extends Controller{
    
    // Di method yang menampilkan detail kost atau kamar
    public function showKost($id)
    {
        $kost = Kost::findOrFail($id);
        
        // Catat klik
        Click::create([
            'kost_id' => $kost->id,
            'user_id' => auth()->id(), // atau null jika pengguna tidak login
        ]);
        
        return view('kost.show', compact('kost'));
    }
    
    public function showRoom($id)
    {
        $room = Room::findOrFail($id);
        
        // Catat klik
        Click::create([
            'kost_id' => $room->kost_id,
            'room_id' => $room->id,
            'user_id' => auth()->id(), // atau null jika pengguna tidak login
        ]);
        
        return view('room.show', compact('room'));
    }
    
    public function index()
    {
        $clicks = Click::all();
        return view('clicks.index', compact('clicks'));
    }

    public function create()
    {
        return view('clicks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kost_id' => 'required|exists:kosts,id',
            'room_id' => 'nullable|exists:rooms,id',
            'user_id' => 'nullable|exists:users,id',
        ]);

        Click::create($request->all());
        return redirect()->route('clicks.index')->with('success', 'Click created successfully.');
    }

    public function show(Click $click)
    {
        return view('clicks.show', compact('click'));
    }

    public function edit(Click $click)
    {
        return view('clicks.edit', compact('click'));
    }

    public function update(Request $request, Click $click)
    {
        $request->validate([
            'kost_id' => 'required|exists:kosts,id',
            'room_id' => 'nullable|exists:rooms,id',
            'user_id' => 'nullable|exists:users,id',
        ]);

        $click->update($request->all());
        return redirect()->route('clicks.index')->with('success', 'Click updated successfully.');
    }

    public function destroy(Click $click)
    {
        $click->delete();
        return redirect()->route('clicks.index')->with('success', 'Click deleted successfully.');
    }
}