<?php

namespace App\Http\Controllers;

use App\Models\OwnerVerification;
use Illuminate\Http\Request;

class OwnerVerificationController extends Controller
{
    public function index()
    {
        $verifications = OwnerVerification::all();
        return view('owner_verifications.index', compact('verifications'));
    }

    public function create()
    {
        return view('owner_verifications.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'status' => 'required|in:pending,approved,rejected',
        ]);

        OwnerVerification::create($request->all());
        return redirect()->route('owner_verifications.index')->with('success', 'Verification created successfully.');
    }

    public function show(OwnerVerification $verification)
    {
        return view('owner_verifications.show', compact('verification'));
    }

    public function edit(OwnerVerification $verification)
    {
        return view('owner_verifications.edit', compact('verification'));
    }

    public function update(Request $request, OwnerVerification $verification)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'status' => 'required|in:pending,approved,rejected',
        ]);

        $verification->update($request->all());
        return redirect()->route('owner_verifications.index')->with('success', 'Verification updated successfully.');
    }

    public function destroy(OwnerVerification $verification)
    {
        $verification->delete();
        return redirect()->route('owner_verifications.index')->with('success', 'Verification deleted successfully.');
    }
}

