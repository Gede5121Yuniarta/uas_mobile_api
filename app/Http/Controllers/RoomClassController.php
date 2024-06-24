<?php

namespace App\Http\Controllers;

use App\Models\RoomClass;
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
        return view('room_classes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'classes_name' => 'required|string|max:255', // Memastikan classes_name diperlukan
            'price' => 'required|numeric',
        ]);

        // Menyimpan room class dengan nilai classes_name dan price dari request
        $roomClass = new RoomClass();
        $roomClass->classes_name = $request->classes_name;
        $roomClass->price = $request->price;
        $roomClass->save();

        return redirect()->route('room_classes.index')->with('success', 'Room Class created successfully.');
    }

    public function show(RoomClass $roomClass)
    {
        return view('room_classes.show', compact('roomClass'));
    }

    public function edit(RoomClass $roomClass)
    {
        return view('room_classes.edit', compact('roomClass'));
    }

    public function update(Request $request, RoomClass $roomClass)
    {
        $request->validate([
            'classes_name' => 'required|string|max:255', // Memastikan classes_name diperlukan
            'price' => 'required|numeric',
        ]);

        // Memperbarui room class dengan nilai classes_name dan price dari request
        $roomClass->classes_name = $request->classes_name;
        $roomClass->price = $request->price;
        $roomClass->save();

        return redirect()->route('room_classes.index')->with('success', 'Room Class updated successfully.');
    }

    public function destroy(RoomClass $roomClass)
    {
        $roomClass->delete();
        return redirect()->route('room_classes.index')->with('success', 'Room Class deleted successfully.');
    }
}
