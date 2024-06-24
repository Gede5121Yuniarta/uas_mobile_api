<?php

namespace App\Http\Controllers;

use App\Models\Kost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class KostController extends Controller
{
    public function index()
    {
        $adminId = Auth::id();
        $kosts = Kost::where('owner_id', $adminId)->paginate(10);

        return view('kosts.index', compact('kosts'));
    }

    public function create()
    {
        return view('kosts.create');
    }

    // public function store(Request $request)
    // {
    //     $validatedData = $request->validate([
    //         'name_kost' => 'required|string|max:255',
    //         'description' => 'nullable|string',
    //         'location' => 'nullable|string',
    //         'latitude' => 'nullable|numeric',
    //         'longitude' => 'nullable|numeric',
    //         'kost_type' => 'required|string|in:campuran,laki-laki,perempuan',
    //         'facilities' => 'nullable|array',
    //         'rules' => 'nullable|array',
    //         // 'media' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
    //         'media' => 'nullable|array|mimes:jpeg,png,jpg,gif,webp,mov,mp4,avi', // Allow video formats
    //         'whatsapp_number' => 'nullable|string',
    //         'facebook' => 'nullable|url',
    //         'instagram' => 'nullable|url',
    //         'twitter' => 'nullable|url',
    //     ]);

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
    //     // Handle file upload
    //     // if ($request->hasFile('media')) {
    //     //     $imageName = time() . '.' . $request->media->extension();
    //     //     $request->media->move(public_path('images/kost'), $imageName);
    //     //     $imagePath = 'images/kost/' . $imageName;
    //     // } else {
    //     //     $imagePath = null;
    //     // }

    //     // $kost = new Kost();
    //     // $kost->name_kost = $request->name_kost;
    //     // $kost->media = $imagePath;
    //     // $kost->save();

    //     // return redirect()->route('kosts.index')->with('success', 'Kost created successfully.');

    //     $uploadedMedia = [];

    //     if ($request->hasFile('media')) {
    //         $files = $request->file('media');  // Assuming multiple files are uploaded as an array

    //         foreach ($files as $file) {
    //             $extension = $file->getClientOriginalExtension();
    //             $allowedExtensions = ['jpeg', 'png', 'jpg', 'gif', 'webp', 'mov', 'mp4', 'avi']; // Allowed extensions

    //             if (!in_array($extension, $allowedExtensions)) {
    //                 return redirect()->back()->withErrors(['media' => 'Invalid file format. Only images and videos allowed.']);
    //             }

    //             $imageName = time() . '.' . $extension;
    //             $file->move(public_path('images/kost'), $imageName);
    //             $uploadedMedia[] = 'images/kost/' . $imageName;
    //         }
    //     }

    //     $kost->media = json_encode($uploadedMedia); // Store uploaded media paths as an array
    //     $kost->save();

    //     return redirect()->route('kosts.index')->with('success', 'Kost updated successfully.');
    // }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name_kost' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'nullable|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'kost_type' => 'required|string|in:campuran,laki-laki,perempuan',
            'facilities' => 'nullable|array',
            'rules' => 'nullable|array',
            'media' => 'nullable|array', // Assuming 'media' is an array of files
            'whatsapp_number' => 'nullable|string',
            'facebook' => 'nullable|url',
            'instagram' => 'nullable|url',
            'twitter' => 'nullable|url',
        ]);

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
        $kost->whatsapp_number = $validatedData['whatsapp_number'];
        $kost->facebook = $validatedData['facebook'];
        $kost->instagram = $validatedData['instagram'];
        $kost->twitter = $validatedData['twitter'];
        $kost->status = 'pending';

        // Handle file upload
        $uploadedMedia = [];

        if ($request->hasFile('media')) {
            $files = $request->file('media');

            foreach ($files as $file) {
                $extension = $file->getClientOriginalExtension();
                $allowedExtensions = ['jpeg', 'png', 'jpg', 'gif', 'webp', 'mov', 'mp4', 'avi'];

                if (!in_array($extension, $allowedExtensions)) {
                    return redirect()->back()->withErrors(['media' => 'Invalid file format. Only images and videos allowed.']);
                }

                $imageName = time() . '_' . uniqid() . '.' . $extension;
                $file->move(public_path('images/kost'), $imageName);
                $uploadedMedia[] = 'images/kost/' . $imageName;
            }
        }

        $kost->media = implode(',', $uploadedMedia); // Store uploaded media paths as a comma-separated string
        $kost->save();

        return redirect()->route('kosts.index')->with('success', 'Kost created successfully.');
    }



    public function edit($id)
    {
        $kost = Kost::findOrFail($id);
        return view('kosts.edit', compact('kost'));
    }

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
    //         'media' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
    //         'whatsapp_number' => 'nullable|string',
    //         'facebook' => 'nullable|url',
    //         'instagram' => 'nullable|url',
    //         'twitter' => 'nullable|url',
    //     ]);

    //     // Find the Kost object to update based on the ID
    //     $kost = Kost::find($kostId);

    //     if (!$kost) {
    //         return redirect()->route('kosts.index')->with('error', 'Kost not found.');
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

    //     // Handle file upload
    //     $kost = Kost::findOrFail($kostId);

    //     if ($request->hasFile('media')) {
    //         if ($kost->media) {
    //             $oldImagePath = public_path($kost->media);
    //             if (file_exists($oldImagePath)) {
    //                 unlink($oldImagePath);
    //             }
    //         }

    //         $imageName = time() . '.' . $request->media->extension();
    //         $request->media->move(public_path('images/kost'), $imageName);
    //         $imagePath = 'images/kost/' . $imageName;
    //     } else {
    //         $imagePath = $kost->media;
    //     }

    //     $kost->name_kost = $request->name_kost;
    //     $kost->media = $imagePath;
    //     $kost->save();

    //     return redirect()->route('kosts.index')->with('success', 'Kost updated successfully.');
    // }

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
            'media' => 'nullable|array', // Assuming 'media' is an array of files
            'whatsapp_number' => 'nullable|string',
            'facebook' => 'nullable|url',
            'instagram' => 'nullable|url',
            'twitter' => 'nullable|url',
        ]);

        // Find the Kost object to update based on the ID
        $kost = Kost::find($kostId);

        if (!$kost) {
            return redirect()->route('kosts.index')->with('error', 'Kost not found.');
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

        // Handle file upload
        $uploadedMedia = explode(',', $kost->media); // Get current media files

        if ($request->hasFile('media')) {
            $files = $request->file('media');

            foreach ($files as $file) {
                $extension = $file->getClientOriginalExtension();
                $allowedExtensions = ['jpeg', 'png', 'jpg', 'gif', 'webp', 'mov', 'mp4', 'avi'];

                if (!in_array($extension, $allowedExtensions)) {
                    return redirect()->back()->withErrors(['media' => 'Invalid file format. Only images and videos allowed.']);
                }

                $imageName = time() . '_' . uniqid() . '.' . $extension;
                $file->move(public_path('images/kost'), $imageName);
                $uploadedMedia[] = 'images/kost/' . $imageName;
            }
        }

        $kost->media = implode(',', $uploadedMedia); // Store uploaded media paths as a comma-separated string
        $kost->save();

        return redirect()->route('kosts.index')->with('success', 'Kost updated successfully.');
    }




    public function destroy($id)
    {
        $kost = Kost::findOrFail($id);
        $kost->delete();

        return redirect()->route('kosts.index')->with('success', 'Kost deleted successfully.');
    }

    public function updateStatus(Request $request, $id)
    {
        $kost = Kost::find($id);
        $kost->status = $request->input('status');
        $kost->save();
        return redirect()->back()->with('status', $kost->status);
    }

    public function indexKost()
    {
        $kosts = Kost::whereIn('status', ['pending', 'confirm', 'reject'])
            ->with('admin') // eager load the admin relationship
            ->latest()
            ->paginate(10);
        return view('superAdmin.indexKost', compact('kosts'));
    }


    public function showDetailForSuperAdmin(Kost $kost, $slug)
    {
        $kost = Kost::where('slug', $slug)->firstOrFail();
        return view('detail', compact('kost'));
    }

}
