<?php

namespace App\Http\Controllers\Backend\Home;

use App\Http\Controllers\Controller;
use App\Models\GrowthSustainabilityDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class SustainabilityDetailsController extends Controller
{
    public function index()
    {
        // Get all sustainability details from the database
        $descriptions = GrowthSustainabilityDetail::whereNull('deleted_by')->get();
        return view('backend.home-page.sustainability-details.index', compact('descriptions'));
    }

    public function create()
    {
        return view('backend.home-page.sustainability-details.create');
    }

public function store(Request $request)
{
    $request->validate([
        // Removed the 'required' rule from the thumbnail_image.* field
        'thumbnail_image.*' => 'image|mimes:jpeg,jpg,png,webp|max:2048',
        'heading.*' => 'required|string|max:255',
        'title.*' => 'required|string|max:255',
        'sustainability_title' => 'required|string|max:255',
        'sustainability_image' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
        'sustainability_description' => 'required|string',
    ]);

    $description = new GrowthSustainabilityDetail();

    // Handle Thumbnail Image Uploads
    $thumbnailImages = [];
    if ($request->hasFile('thumbnail_image')) {
        foreach ($request->file('thumbnail_image') as $thumbnail) {
            if ($thumbnail->isValid()) {
                $extension = $thumbnail->getClientOriginalExtension();
                $imageName = time() . rand(10, 999) . '.' . $extension;
                $thumbnail->move(public_path('bhojwani/home/sustainability'), $imageName);
                $thumbnailImages[] = $imageName; // Store only filename
            }
        }
    }

    // Handle Sustainability Image Upload
    $sustainabilityImagePath = null;
    if ($request->hasFile('sustainability_image')) {
        $sustainabilityImage = $request->file('sustainability_image');
        if ($sustainabilityImage->isValid()) {
            $extension = $sustainabilityImage->getClientOriginalExtension();
            $sustainabilityImageName = time() . rand(1000, 9999) . '.' . $extension;
            $sustainabilityImage->move(public_path('bhojwani/home/sustainability'), $sustainabilityImageName);
            $sustainabilityImagePath = $sustainabilityImageName; // ✅ Only store filename
        }
    }

    // Save to DB
    $description->thumbnail_images = json_encode($thumbnailImages);
    $description->heading = json_encode($request->input('heading'));
    $description->title = json_encode($request->input('title'));
    $description->sustainability_title = $request->input('sustainability_title');
    $description->sustainability_image = $sustainabilityImagePath;
    $description->sustainability_description = $request->input('sustainability_description');
    $description->created_by = Auth::id();
    $description->save();

    return redirect()->route('growth-sustainability-details.index')->with('message', 'Home Page Description added successfully!');
}


    public function edit($id)
    {
        $description = GrowthSustainabilityDetail::findOrFail($id);
        return view('backend.home-page.sustainability-details.edit', compact('description'));
    }

    public function update(Request $request, $id)
{
    $description = GrowthSustainabilityDetail::findOrFail($id);

    $request->validate([
        'thumbnail_image.*' => 'image|mimes:jpeg,jpg,png,webp|max:2048',
        'heading.*' => 'required|string|max:255',
        'title.*' => 'required|string|max:255',
        'sustainability_title' => 'required|string|max:255',
        'sustainability_image' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
        'sustainability_description' => 'required|string',
    ]);

    // Handle new sustainability image
    if ($request->hasFile('sustainability_image')) {
        // Delete old image file (if it exists)
        $oldImagePath = public_path('bhojwani/home/sustainability/' . $description->sustainability_image);
        if (file_exists($oldImagePath)) {
            @unlink($oldImagePath);
        }

        $image = $request->file('sustainability_image');
        if ($image->isValid()) {
            $extension = $image->getClientOriginalExtension();
            $imageName = time() . rand(1000, 9999) . '.' . $extension;
            $image->move(public_path('bhojwani/home/sustainability'), $imageName);
            $description->sustainability_image = $imageName; // ✅ Only filename saved
        }
    }

    // Optional: Handle updated thumbnail images (if sent)
    if ($request->hasFile('thumbnail_image')) {
        $thumbnailImages = [];
        foreach ($request->file('thumbnail_image') as $thumbnail) {
            if ($thumbnail->isValid()) {
                $extension = $thumbnail->getClientOriginalExtension();
                $imageName = time() . rand(10, 999) . '.' . $extension;
                $thumbnail->move(public_path('bhojwani/home/sustainability'), $imageName);
                $thumbnailImages[] = $imageName;
            }
        }
        $description->thumbnail_images = json_encode($thumbnailImages);
    }

    // Update other fields
    $description->heading = json_encode($request->input('heading'));
    $description->title = json_encode($request->input('title'));
    $description->sustainability_title = $request->input('sustainability_title');
    $description->sustainability_description = $request->input('sustainability_description');
    $description->updated_by = Auth::id();
    $description->save();

    return redirect()->route('growth-sustainability-details.index')->with('message', 'Home Page Description updated successfully!');
}

    public function destroy($id)
    {
        $description = GrowthSustainabilityDetail::findOrFail($id);
        $description->update([
            'deleted_by' => Auth::id(),
            'deleted_at' => Carbon::now(),
        ]);

        return redirect()->route('growth-sustainability-details.index')->with('message', 'Home Page Description deleted successfully!');
    }
}
