<?php

namespace App\Http\Controllers;

use App\Models\RoomClass;
use App\Models\Kost;
use Illuminate\Http\Request;

class RoomClassController extends Controller
{
    public function index()
    {
        $roomClasses = RoomClass::paginate(10);
        return view('room_classes.index', compact('roomClasses'));
    }

    public function create()
    {
        $kosts = Kost::all();
        return view('room_classes.create', compact('kosts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kost_id' => 'required|exists:kosts,id', // Memastikan kost_id diperlukan dan ada di tabel kosts
            'classes_name' => 'required|string|max:255', // Memastikan classes_name diperlukan
            'price' => 'required|numeric',
            'facilities' => 'nullable|array',
        ]);

        // Menyimpan room class dengan nilai kost_id, classes_name, dan price dari request
        $roomClass = new RoomClass();
        $roomClass->kost_id = $request->kost_id;
        $roomClass->classes_name = $request->classes_name;
        $roomClass->price = $request->price;
        $roomClass->facilities = json_encode($request->input('facilities', []));
        $roomClass->save();

        return redirect()->route('room_classes.index')->with('success', 'Room Class created successfully.');
    }

    public function show(RoomClass $roomClass)
    {
        return view('room_classes.show', compact('roomClass'));
    }

    public function edit(RoomClass $roomClass)
    {
        $kosts = Kost::all();
        return view('room_classes.edit', compact('roomClass', 'kosts'));
    }

    public function update(Request $request, RoomClass $roomClass)
    {
        $request->validate([
            'kost_id' => 'required|exists:kosts,id', // Memastikan kost_id diperlukan dan ada di tabel kosts
            'classes_name' => 'required|string|max:255', // Memastikan classes_name diperlukan
            'price' => 'required|numeric',
            'facilities' => 'nullable|array',
        ]);

        // Memperbarui room class dengan nilai kost_id, classes_name, dan price dari request
        $roomClass->kost_id = $request->kost_id;
        $roomClass->classes_name = $request->classes_name;
        $roomClass->price = $request->price;
        $roomClass->facilities = json_encode($request->input('facilities', []));
        $roomClass->save();

        return redirect()->route('room_classes.index')->with('success', 'Room Class updated successfully.');
    }

    public function destroy(RoomClass $roomClass)
    {
        $roomClass->delete();
        return redirect()->route('room_classes.index')->with('success', 'Room Class deleted successfully.');
    }
}
