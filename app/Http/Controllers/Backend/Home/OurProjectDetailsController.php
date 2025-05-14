<?php

namespace App\Http\Controllers\Backend\Home;

use App\Models\OurProjectCategory;
use App\Models\OurProjectDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;

class OurProjectDetailsController extends Controller
{
    public function index()
    {
        $projects = OurProjectDetail::all();
        return view('backend.our-project.ourproject-details.index', compact('projects'));
    }

    public function create()
    {
        $categories = OurProjectCategory::all();
        return view('backend.our-project.ourproject-details.create', compact('categories'));
    }

  public function store(Request $request)
{
    $request->validate([
        'project_heading' => 'required|string|max:255',
                    'title' => 'required|string|max:255',

        'location' => 'required|string|max:255',
        'banner_image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        'project_image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        'category_id' => 'required|exists:our_project_categories,id',
    ]);

    // Save banner image
    $bannerImage = $request->file('banner_image');
    $bannerImageName = time() . '_banner.' . $bannerImage->getClientOriginalExtension();
    $bannerImage->move(public_path('bhojwani/project/banner'), $bannerImageName);

    // Save project image
    $projectImage = $request->file('project_image');
    $projectImageName = time() . '_project.' . $projectImage->getClientOriginalExtension();
    $projectImage->move(public_path('bhojwani/project/project_images'), $projectImageName);

    // Generate slug
    $slug = Str::slug($request->project_heading, '-');

    // Create new project
    OurProjectDetail::create([
        'project_heading' => $request->project_heading,
                    'title' => $request->title,

        'slug' => $slug,
        'location' => $request->location,
        'banner_image' => $bannerImageName, // Only store the file name
        'project_image' => $projectImageName, // Only store the file name
        'category_id' => $request->category_id,
        'created_by' => Auth::id(),
    ]);

    return redirect()->route('ourproject-details.index')->with('message', 'Project Details added successfully!');
}

    public function edit($id)
    {
        $project = OurProjectDetail::findOrFail($id);
        $categories = OurProjectCategory::all();
        return view('backend.our-project.ourproject-details.edit', compact('project', 'categories'));
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'project_heading' => 'required|string|max:255',
         'title' => 'required|string|max:255',
        'location' => 'required|string|max:255',
        'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        'project_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        'category_id' => 'required|exists:our_project_categories,id',
    ]);

    $project = OurProjectDetail::findOrFail($id);

    if ($request->hasFile('banner_image')) {
        $bannerImage = $request->file('banner_image');
        $bannerImageName = time() . '_banner.' . $bannerImage->getClientOriginalExtension();
        $bannerImage->move(public_path('bhojwani/project/banner'), $bannerImageName);
        $project->banner_image = $bannerImageName; // Store only the file name
    }

    if ($request->hasFile('project_image')) {
        $projectImage = $request->file('project_image');
        $projectImageName = time() . '_project.' . $projectImage->getClientOriginalExtension();
        $projectImage->move(public_path('bhojwani/project/project_images'), $projectImageName);
        $project->project_image = $projectImageName; // Store only the file name
    }

    // Update project details
    $project->update([
        'project_heading' => $request->project_heading,
     'title' => $request->title,
        'slug' => Str::slug($request->project_heading, '-'),
        'location' => $request->location,
        'category_id' => $request->category_id,
        'updated_by' => Auth::id(),
    ]);

    return redirect()->route('ourproject-details.index')->with('message', 'Project Details updated successfully!');
}


    public function destroy($id)
    {
        $project = OurProjectDetail::findOrFail($id);
        $project->update([
            'deleted_by' => Auth::id(),
            'deleted_at' => Carbon::now(),
        ]);

        return redirect()->route('ourproject-details.index')->with('message', 'Project Details marked as deleted successfully!');
    }
}
