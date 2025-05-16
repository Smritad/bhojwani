<?php

namespace App\Http\Controllers\Backend\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\ProjectAmenity;
use Exception;

class ProjectAmenityController extends Controller
{
    public function index()
    {
        $amenities = ProjectAmenity::all();
        return view('backend.our-project.project-amenity.index', compact('amenities'));
    }

    public function create()
    {
        return view('backend.our-project.project-amenity.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'banner_image' => 'required|image|mimes:jpeg,jpg,png,webp,svg|max:204800',
            'description' => 'required|string',
            'thumbnail_image.*' => 'mimes:jpeg,jpg,png,webp,svg|max:204800',
            'heading.*' => 'required|string',
            'title.*' => 'required|string',
        ]);

        $data = [];

        // Banner Image
        if ($request->hasFile('banner_image')) {
            $file = $request->file('banner_image');
            $bannerName = Str::random(20) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/amenity/banner'), $bannerName);
            $data['banner_image'] = $bannerName;
        }

        $data['description'] = $request->description;

        // Handle thumbnail images
        $thumbnails = [];
        if ($request->hasFile('thumbnail_image')) {
            foreach ($request->file('thumbnail_image') as $file) {
                $thumbName = Str::random(20) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/amenity/thumbnail'), $thumbName);
                $thumbnails[] = $thumbName;
            }
        }

        $data['thumbnail_images'] = implode(',', $thumbnails);
        $data['headings'] = implode(',', $request->heading);
        $data['titles'] = implode(',', $request->title);
        $data['created_by'] = Auth::id();

        ProjectAmenity::create($data);

        return redirect()->route('projectamenity-details.index')->with('message', 'Amenity added successfully!');
    }

    public function edit($id)
    {
        $projectAmenity = ProjectAmenity::findOrFail($id);

        $thumbnailImages = explode(',', $projectAmenity->thumbnail_images);
        $headings = explode(',', $projectAmenity->headings);
        $titles = explode(',', $projectAmenity->titles);

        $amenities = [];
        for ($i = 0; $i < count($headings); $i++) {
            $amenities[] = [
                'image' => $thumbnailImages[$i] ?? '',
                'heading' => $headings[$i] ?? '',
                'title' => $titles[$i] ?? '',
            ];
        }

        return view('backend.our-project.project-amenity.edit', compact('projectAmenity', 'amenities'));
    }

    public function update(Request $request, $id)
    {
        $projectAmenity = ProjectAmenity::findOrFail($id);

        $request->validate([
            'banner_image' => 'nullable|image|mimes:jpeg,jpg,png,webp,svg|max:204800',
            'description' => 'required|string',
            'thumbnail_image.*' => 'mimes:jpeg,jpg,png,webp,svg|max:204800',
            'heading.*' => 'required|string',
            'title.*' => 'required|string',
        ]);

        $data = [];

        // Banner Image
        if ($request->hasFile('banner_image')) {
            if ($projectAmenity->banner_image && file_exists(public_path('uploads/amenity/banner/' . $projectAmenity->banner_image))) {
                unlink(public_path('uploads/amenity/banner/' . $projectAmenity->banner_image));
            }

            $file = $request->file('banner_image');
            $bannerName = Str::random(20) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/amenity/banner'), $bannerName);
            $data['banner_image'] = $bannerName;
        }

        $data['description'] = $request->description;

        // Handle thumbnails (new or fallback to old)
        $thumbnails = [];
        $uploadedFiles = $request->file('thumbnail_image', []);
        $oldFiles = $request->input('old_thumbnail_image', []);

        foreach ($request->heading as $i => $heading) {
            if (isset($uploadedFiles[$i]) && $uploadedFiles[$i]) {
                $file = $uploadedFiles[$i];
                $thumbName = Str::random(20) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/amenity/thumbnail'), $thumbName);
                $thumbnails[] = $thumbName;
            } elseif (isset($oldFiles[$i])) {
                $thumbnails[] = $oldFiles[$i];
            } else {
                $thumbnails[] = ''; // Optional: add error check
            }
        }

        $data['thumbnail_images'] = implode(',', $thumbnails);
        $data['headings'] = implode(',', $request->heading);
        $data['titles'] = implode(',', $request->title);
        $data['updated_by'] = Auth::id();

        $projectAmenity->update($data);

        return redirect()->route('projectamenity-details.index')->with('message', 'Amenity updated successfully!');
    }

    public function destroy($id)
    {
        try {
            $projectAmenity = ProjectAmenity::findOrFail($id);

            if ($projectAmenity->banner_image && file_exists(public_path('uploads/amenity/banner/' . $projectAmenity->banner_image))) {
                unlink(public_path('uploads/amenity/banner/' . $projectAmenity->banner_image));
            }

            $thumbnailImages = explode(',', $projectAmenity->thumbnail_images);
            foreach ($thumbnailImages as $thumbnail) {
                if (file_exists(public_path('uploads/amenity/thumbnail/' . $thumbnail))) {
                    unlink(public_path('uploads/amenity/thumbnail/' . $thumbnail));
                }
            }

            $projectAmenity->delete();

            return redirect()->route('projectamenity-details.index')->with('message', 'Amenity deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something went wrong: ' . $ex->getMessage());
        }
    }
}
