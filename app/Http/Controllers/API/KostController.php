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
    public function index()
    {
        // $data = Kost::all();
        $data = Kost::getKost()->get();
        return response()->json($data);
    }

    // public function getKostsByAdmin($id)
    // {
    //     Log::info("Request to get Kosts for admin with ID: $id");

    //     // Find the user by ID
    //     $user = User::find($id);

    //     if (!$user) {
    //         Log::warning("Admin with ID $id not found.");
    //         return response()->json(['message' => 'Admin not found'], 404);
    //     }

    //     // Get the kosts related to the admin
    //     $kosts = $user->kosts;

    //     return response()->json($kosts, 200);
    // }
    public function getKostByOwnerId($owner_id)
    {
        try {
            $kosts = Kost::where('owner_id', $owner_id)->get();

            if ($kosts->isEmpty()) {
                return response()->json([
                    'message' => 'No kost found for the given owner_id.'
                ], 404);
            }

            return response()->json($kosts, 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while fetching the data.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $owner_id)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name_kost' => 'required|string|max:255',
            'description' => 'nullable|string',
            'kost_type' => 'required|string|in:campuran,laki-laki,perempuan',
            'facilities' => 'nullable|array',
            'rules' => 'nullable|array',
            'location' => 'nullable|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'whatsapp_number' => 'nullable|string|max:15',
            'media' => 'nullable|array',
            'facebook' => 'nullable|url',
            'instagram' => 'nullable|url',
            'twitter' => 'nullable|url',
        ]);

        // Create a new Kost object
        $kost = new Kost();
        $kost->owner_id = $owner_id;
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
        $kost->status = 'pending';

        if ($request->has('media')) {
            $kost->media = $validatedData['media'];
        }

        $kost->save();

        return response()->json(['message' => 'Kost added successfully.']);
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
    public function update(Request $request, $owner_id, $id)
    {
        // Validasi data yang diterima
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

        // Temukan kost berdasarkan owner_id dan id
        $kost = Kost::where('owner_id', $owner_id)->where('id', $id)->first();

        if (!$kost) {
            return response()->json(['message' => 'Kost not found.'], 404);
        }

        // Update properti kost dengan data yang divalidasi
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


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($owner_id, $id)
    {
        // Find the kost by id and owner_id
        $kost = Kost::where('owner_id', $owner_id)->where('id', $id)->first();

        if (!$kost) {
            return response()->json(['message' => 'Kost not found.'], 404);
        }

        // Delete the kost
        $kost->delete();

        return response()->json(['message' => 'Kost deleted successfully.']);
    }


    // public function index(Request $request)
    // {
    //     $userId = auth()->id();
    //     Log::info("User ID: $userId"); // Log the user ID

    //     $kosts = Kost::where('owner_id', $userId)->paginate(10);
    //     Log::info("Kosts: " . $kosts->count()); // Log the number of kosts found

    //     return response()->json($kosts);
    // }

    // public function index(Request $request)
    // {
    //     if (!auth()->check()) {
    //         return response()->json(['error' => 'Unauthorized'], 401);
    //     }

    //     $userId = auth()->id();
    //     Log::info("User ID: $userId"); // Log the user ID

    //     $kosts = Kost::where('owner_id', $userId)->paginate(10);
    //     Log::info("Kosts: " . $kosts->count()); // Log the number of kosts found

    //     $data = [
    //         'user_id' => $userId,
    //         'kosts' => $kosts,
    //         'request_data' => $request->all(),
    //     ];

    //     return response()->json($data);
    // }

    // public function store(Request $request)
    // {
    //     // Validate the request data
    //     $validatedData = $request->validate([
    //         'name_kost' => 'required|string|max:255',
    //         'description' => 'nullable|string',
    //         'location' => 'nullable|string',
    //         'latitude' => 'nullable|numeric',
    //         'longitude' => 'nullable|numeric',
    //         'kost_type' => 'required|string|in:campuran,laki-laki,perempuan',
    //         'facilities' => 'nullable|array',
    //         'rules' => 'nullable|array',
    //         'media' => 'nullable|file',
    //         'whatsapp_number' => 'nullable|string|max:15',
    //         'facebook' => 'nullable|url',
    //         'instagram' => 'nullable|url',
    //         'twitter' => 'nullable|url',
    //     ]);

    //     // Create a new Kost object
    //     $kost = new Kost();
    //     $kost->owner_id = auth()->id();
    //     $kost->name_kost = $validatedData['name_kost'];
    //     $kost->description = $validatedData['description'];
    //     $kost->location = $validatedData['location'];
    //     $kost->latitude = $validatedData['latitude'];
    //     $kost->longitude = $validatedData['longitude'];
    //     $kost->kost_type = $validatedData['kost_type'];
    //     $kost->facilities = json_encode($validatedData['facilities']);
    //     $kost->rules = json_encode($validatedData['rules']);
    //     $kost->media = $validatedData['media'];
    //     $kost->whatsapp_number = $validatedData['whatsapp_number'];
    //     $kost->facebook = $validatedData['facebook'];
    //     $kost->instagram = $validatedData['instagram'];
    //     $kost->twitter = $validatedData['twitter'];
    //     $kost->status = 'pending';

    //     if ($request->hasFile('media')) {
    //         $file = $request->file('media');
    //         $filename = time() . '.' . $file->getClientOriginalExtension();
    //         $path = Storage::disk('public')->putFileAs('kost', $file, $filename);
    //         $kost->media = $filename;
    //     }

    //     $kost->save();

    //     return response()->json(['message' => 'Kost added successfully.']);
    // }

    // public function show($id)
    // {
    //     $kost = Kost::findOrFail($id);

    //     return response()->json($kost);
    // }

    // public function update(Request $request, $kostId)
    // {
    //     // Validate the request data
    //     $validatedData = $request->validate([
    //         'name_kost' => 'required|string|max:255',
    //         'description' => 'nullable|string',
    //         'location' => 'nullable|string',
    //         'latitude' => 'nullable|numeric',
    //         'longitude' => 'nullable|numeric',
    //         'kost_type' => 'required|string|in:campuran,laki-laki,perempuan',
    //         'facilities' => 'nullable|array',
    //         'rules' => 'nullable|array',
    //         'media' => 'nullable|file',
    //         'whatsapp_number' => 'nullable|string|max:15',
    //         'facebook' => 'nullable|url',
    //         'instagram' => 'nullable|url',
    //         'twitter' => 'nullable|url',
    //     ]);

    //     // Find the Kost object to update based on the ID
    //     $kost = Kost::find($kostId);

    //     if (!$kost) {
    //         return response()->json(['error' => 'Kost not found.'], 404);
    //     }

    //     // Update the Kost object properties with validated data
    //     $kost->name_kost = $validatedData['name_kost'];
    //     $kost->description = $validatedData['description'];
    //     $kost->location = $validatedData['location'];
    //     $kost->latitude = $validatedData['latitude'];
    //     $kost->longitude = $validatedData['longitude'];
    //     $kost->kost_type = $validatedData['kost_type'];
    //     $kost->facilities = json_encode($validatedData['facilities']);
    //     $kost->rules = json_encode($validatedData['rules']);
    //     $kost->whatsapp_number = $validatedData['whatsapp_number'];
    //     $kost->facebook = $validatedData['facebook'];
    //     $kost->instagram = $validatedData['instagram'];
    //     $kost->twitter = $validatedData['twitter'];

    //     if ($request->hasFile('media')) {
    //         $file = $request->file('media');
    //         $filename = time() . '.' . $file->getClientOriginalExtension();
    //         $path = Storage::disk('public')->putFileAs('kost', $file, $filename);
    //         $kost->media = $filename;
    //     }

    //     $kost->save();

    //     return response()->json(['message' => 'Kost updated successfully.']);
    // }

    // public function destroy($id)
    // {
    //     $kost = Kost::find($id);

    //     if (!$kost) {
    //         return response()->json(['error' => 'Kost not found.'], 404);
    //     }

    //     $kost->delete();

    //     return response()->json(['message' => 'Kost deleted successfully.']);
    // }
}
