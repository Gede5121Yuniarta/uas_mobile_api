<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     $data = Room::getRoom()->get();
    //     // $data = Room::getRoom()->paginate(1);
    //     return response()->json($data);
    // }
    public function index()
    {
        $data = Room::getRoom(); // get() sudah dipanggil dalam method getRoom()
        return response()->json($data);
    }

    // Contoh Laravel Controller
    public function getRoomsByKost($kostId)
    {
        $rooms = Room::where('kost_id', $kostId)->get();
        return response()->json($rooms);
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
