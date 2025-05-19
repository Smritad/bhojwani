<?php

namespace App\Http\Controllers\Backend\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GalleryImage;
use Illuminate\Support\Facades\File;
use App\Models\OurProjectDetail;

class GalleryImageController extends Controller
{
    public function index()
    {
        // Include soft deleted if needed, else only non-deleted entries
        $galleryImages = GalleryImage::all();
        return view('backend.our-project.galleryimage.index', compact('galleryImages'));
    }

    public function create()
    {
                  $projectid = OurProjectDetail::all();

        return view('backend.our-project.galleryimage.create',compact('projectid'));
    }

   public function store(Request $request)
{
    $request->validate([
        'project_id' => 'required|string',
        'section1_heading' => 'required|string|max:255',
        'gallery_images.*' => 'required|image|mimes:jpg,jpeg,png,webp',
    ]);

    $imageFilenames = [];

    if ($request->hasFile('gallery_images')) {
        foreach ($request->file('gallery_images') as $file) {
            $filename = time() . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/gallery'), $filename);
            $imageFilenames[] = $filename;
        }
    }

    GalleryImage::create([
        'project_id' => $request->project_id,
        'section1_heading' => $request->section1_heading,
        'images' => implode(',', $imageFilenames),
        'created_by' => auth()->id(),
        'updated_by' => auth()->id(),
    ]);

    return redirect()->route('galleryimage-details.index')->with('message', 'Gallery images added successfully!');
}


    public function edit($id)
    {
        $galleryImage = GalleryImage::findOrFail($id);
        $images = explode(',', $galleryImage->images);
                  $projectid = OurProjectDetail::all();

        return view('backend.our-project.galleryimage.edit', compact('galleryImage', 'images'),compact('projectid'));
    }

    public function update(Request $request, $id)
    {
        $galleryImage = GalleryImage::findOrFail($id);

        $request->validate([
            'section1_heading' => 'required|string|max:255',
            'gallery_images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048000',
        ]);

        $existingImages = $request->input('existing_images', []);
        $uploadedImages = [];

        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $file) {
                $filename = time() . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/gallery'), $filename);
                $uploadedImages[] = $filename;
            }
        }

        $allImages = array_merge($existingImages, $uploadedImages);

        $galleryImage->update([
            'section1_heading' => $request->section1_heading,
            'images' => implode(',', $allImages),
            'updated_by' => auth()->id(),  // update editor id
        ]);

        return redirect()->route('galleryimage-details.index')->with('message', 'Gallery images updated successfully!');
    }

    public function destroy($id)
    {
        $galleryImage = GalleryImage::findOrFail($id);

        // Delete files from disk
        $images = explode(',', $galleryImage->images);
        foreach ($images as $img) {
            $filePath = public_path('uploads/gallery/' . $img);
            if (File::exists($filePath)) {
                File::delete($filePath);
            }
        }

        // Instead of hard delete, soft delete and set deleted_by
        $galleryImage->deleted_by = auth()->id();
        $galleryImage->save();
        $galleryImage->delete(); // soft delete (sets deleted_at)

        return redirect()->route('galleryimage-details.index')->with('message', 'Gallery entry deleted successfully!');
    }
}
