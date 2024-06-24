<?php

// App/Http/Controllers/API/KostAPIController.php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Kost;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class KostController extends Controller
{
    // public function index(Request $request)
    // {
    //     $userId = auth()->id();
    //     Log::info("User ID: $userId"); // Log the user ID

    //     $kosts = Kost::where('owner_id', $userId)->paginate(10);
    //     Log::info("Kosts: " . $kosts->count()); // Log the number of kosts found

    //     return response()->json($kosts);
    // }

    public function getKostsByAdmin($id)
    {
        Log::info("Request to get Kosts for admin with ID: $id");

        // Find the user by ID
        $user = User::find($id);

        if (!$user) {
            Log::warning("Admin with ID $id not found.");
            return response()->json(['message' => 'Admin not found'], 404);
        }

        // Get the kosts related to the admin
        $kosts = $user->kosts;

        return response()->json($kosts, 200);
    }

    public function index(Request $request)
    {
        if (!auth()->check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $userId = auth()->id();
        Log::info("User ID: $userId"); // Log the user ID

        $kosts = Kost::where('owner_id', $userId)->paginate(10);
        Log::info("Kosts: " . $kosts->count()); // Log the number of kosts found

        $data = [
            'user_id' => $userId,
            'kosts' => $kosts,
            'request_data' => $request->all(),
        ];

        return response()->json($data);
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name_kost' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'nullable|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'kost_type' => 'required|string|in:campuran,laki-laki,perempuan',
            'facilities' => 'nullable|array',
            'rules' => 'nullable|array',
            'media' => 'nullable|file',
            'whatsapp_number' => 'nullable|string|max:15',
            'facebook' => 'nullable|url',
            'instagram' => 'nullable|url',
            'twitter' => 'nullable|url',
        ]);

        // Create a new Kost object
        $kost = new Kost();
        $kost->owner_id = auth()->id();
        $kost->name_kost = $validatedData['name_kost'];
        $kost->description = $validatedData['description'];
        $kost->location = $validatedData['location'];
        $kost->latitude = $validatedData['latitude'];
        $kost->longitude = $validatedData['longitude'];
        $kost->kost_type = $validatedData['kost_type'];
        $kost->facilities = json_encode($validatedData['facilities']);
        $kost->rules = json_encode($validatedData['rules']);
        $kost->media = $validatedData['media'];
        $kost->whatsapp_number = $validatedData['whatsapp_number'];
        $kost->facebook = $validatedData['facebook'];
        $kost->instagram = $validatedData['instagram'];
        $kost->twitter = $validatedData['twitter'];
        $kost->status = 'pending';

        if ($request->hasFile('media')) {
            $file = $request->file('media');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = Storage::disk('public')->putFileAs('kost', $file, $filename);
            $kost->media = $filename;
        }

        $kost->save();

        return response()->json(['message' => 'Kost added successfully.']);
    }

    public function show($id)
    {
        $kost = Kost::findOrFail($id);

        return response()->json($kost);
    }

    public function update(Request $request, $kostId)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name_kost' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'nullable|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'kost_type' => 'required|string|in:campuran,laki-laki,perempuan',
            'facilities' => 'nullable|array',
            'rules' => 'nullable|array',
            'media' => 'nullable|file',
            'whatsapp_number' => 'nullable|string|max:15',
            'facebook' => 'nullable|url',
            'instagram' => 'nullable|url',
            'twitter' => 'nullable|url',
        ]);

        // Find the Kost object to update based on the ID
        $kost = Kost::find($kostId);

        if (!$kost) {
            return response()->json(['error' => 'Kost not found.'], 404);
        }

        // Update the Kost object properties with validated data
        $kost->name_kost = $validatedData['name_kost'];
        $kost->description = $validatedData['description'];
        $kost->location = $validatedData['location'];
        $kost->latitude = $validatedData['latitude'];
        $kost->longitude = $validatedData['longitude'];
        $kost->kost_type = $validatedData['kost_type'];
        $kost->facilities = json_encode($validatedData['facilities']);
        $kost->rules = json_encode($validatedData['rules']);
        $kost->whatsapp_number = $validatedData['whatsapp_number'];
        $kost->facebook = $validatedData['facebook'];
        $kost->instagram = $validatedData['instagram'];
        $kost->twitter = $validatedData['twitter'];

        if ($request->hasFile('media')) {
            $file = $request->file('media');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = Storage::disk('public')->putFileAs('kost', $file, $filename);
            $kost->media = $filename;
        }

        $kost->save();

        return response()->json(['message' => 'Kost updated successfully.']);
    }

    public function destroy($id)
    {
        $kost = Kost::find($id);

        if (!$kost) {
            return response()->json(['error' => 'Kost not found.'], 404);
        }

        $kost->delete();

        return response()->json(['message' => 'Kost deleted successfully.']);
    }
}