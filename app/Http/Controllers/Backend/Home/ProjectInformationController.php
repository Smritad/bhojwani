<?php

namespace App\Http\Controllers\Backend\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProjectInformation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Exception;
use App\Models\OurProjectCategory;
use App\Models\OurProjectDetail;

class ProjectInformationController extends Controller
{
    public function index()
    {
        $project_details = ProjectInformation::whereNull('deleted_at')->get();
        return view('backend.our-project.project-information.index', compact('project_details'));
    }

    
public function create()
    {
        $categories = OurProjectDetail::all();
        return view('backend.our-project.project-information.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'banner_image' => 'required|array',
            'banner_image.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:512000',
            'banner_heading' => 'required|string|max:255',
            'banner_description' => 'required|string',
            'category_id' => 'required|exists:our_project_categories,id',

            'description_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:512000',
            'description' => 'required|string',
            'heading' => 'required|string|max:255',
            'more_description' => 'required|string',

            'more_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:512000',
        ]);

        $data = [];

        // Save multiple banner images
        $bannerImageNames = [];
        foreach ($request->file('banner_image') as $file) {
            $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('bhojwani/project_information/banner'), $filename);
            $bannerImageNames[] = $filename;
        }
        $data['banner_image'] = json_encode($bannerImageNames);

        // Description image
        $descImage = $request->file('description_image');
        $descImageName = Str::random(40) . '.' . $descImage->getClientOriginalExtension();
        $descImage->move(public_path('bhojwani/project_information/project_image'), $descImageName);
        $data['description_image'] = $descImageName;

        // More image
        $moreImage = $request->file('more_image');
        $moreImageName = Str::random(40) . '.' . $moreImage->getClientOriginalExtension();
        $moreImage->move(public_path('bhojwani/project_information/project_image'), $moreImageName);
        $data['more_image'] = $moreImageName;

        // Other fields
        $data['banner_heading'] = $request->banner_heading;
        $data['banner_description'] = $request->banner_description;
        $data['category_id'] = $request->category_id;
        $data['description'] = $request->description;
        $data['heading'] = $request->heading;
        $data['more_description'] = $request->more_description;
        $data['created_by'] = Auth::id();

        ProjectInformation::create($data);

        return redirect()->route('projectinformation-details.index')->with('message', 'Project Information successfully added!');
    }

    public function edit($id)
    {
        $project_detail = ProjectInformation::findOrFail($id);
          $categories = OurProjectDetail::all();

        return view('backend.our-project.project-information.edit', compact('project_detail','categories'));
    }

    public function update(Request $request, $id)
    {
        $project = ProjectInformation::findOrFail($id);

        $request->validate([
            'banner_heading' => 'required|string|max:255',
            'banner_description' => 'required|string',
            'category_id' => 'required|exists:our_project_categories,id',
            'description' => 'required|string',
            'heading' => 'required|string|max:255',
            'more_description' => 'required|string',
            'banner_image' => 'nullable|array',
            'banner_image.*' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:512000',
            'description_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:512000',
            'more_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:512000',
        ]);

        $data = [];

        // Handle updated banner images
        if ($request->hasFile('banner_image')) {
            $bannerImageNames = [];
            foreach ($request->file('banner_image') as $file) {
                $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('bhojwani/project_information/banner'), $filename);
                $bannerImageNames[] = $filename;
            }

            // Replace existing banner images (or merge if needed)
            $data['banner_image'] = json_encode($bannerImageNames);
        }

        // Description image
        if ($request->hasFile('description_image')) {
            $descImage = $request->file('description_image');
            $descImageName = Str::random(40) . '.' . $descImage->getClientOriginalExtension();
            $descImage->move(public_path('bhojwani/project_information/project_image'), $descImageName);
            $data['description_image'] = $descImageName;
        }

        // More image
        if ($request->hasFile('more_image')) {
            $moreImage = $request->file('more_image');
            $moreImageName = Str::random(40) . '.' . $moreImage->getClientOriginalExtension();
            $moreImage->move(public_path('bhojwani/project_information/project_image'), $moreImageName);
            $data['more_image'] = $moreImageName;
        }

        // Other fields
        $data['banner_heading'] = $request->banner_heading;
        $data['banner_description'] = $request->banner_description;
        $data['description'] = $request->description;
        $data['heading'] = $request->heading;
        $data['more_description'] = $request->more_description;
        $data['updated_by'] = Auth::id();

        $project->update($data);

        return redirect()->route('projectinformation-details.index')->with('message', 'Project Information updated successfully!');
    }

    public function destroy($id)
    {
        try {
            $project = ProjectInformation::findOrFail($id);
            $project->update([
                'deleted_by' => Auth::id(),
                'deleted_at' => Carbon::now()
            ]);

            return redirect()->route('projectinformation-details.index')->with('message', 'Project Information deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something went wrong: ' . $ex->getMessage());
        }
    }
}
