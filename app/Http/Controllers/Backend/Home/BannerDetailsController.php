<?php

namespace App\Http\Controllers\Backend\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Permission;
use App\Models\UsersPermission;
use App\Models\BannerDetails;


class BannerDetailsController extends Controller
{

    public function index()
    {
        $banner_details = BannerDetails::leftJoin('users', 'banner_details.created_by', '=', 'users.id')
                                            ->whereNull('banner_details.deleted_by')
                                            ->select('banner_details.*', 'users.name as creator_name')
                                            ->get();
        return view('backend.home-page.banner-details.index', compact('banner_details'));
    }

    public function create(Request $request)
    { 
        return view('backend.home-page.banner-details.create');
    }


  public function store(Request $request)
{
    // Validate the form inputs
    $request->validate([
        'banner_image.*' => 'required|image|max:5120',  // Allow multiple banner images
        'banner_heading' => 'required|string|max:255',
        'banner_description' => 'required|string',
        'description_image' => 'required|image',
        'description' => 'required|string',
        'heading' => 'required|string|max:255',
        'more_description' => 'required|string',
        'more_image' => 'required|image'
    ]);

    $data = [];

    // Handling multiple banner images
    if ($request->hasFile('banner_image')) {
        $bannerImageNames = [];
        foreach ($request->file('banner_image') as $file) {
            $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('bhojwani/project_information/banner'), $filename);
            $bannerImageNames[] = $filename;
        }
        $data['banner_images'] = json_encode($bannerImageNames); // Store images as a JSON array
    }

    // Handle other images
    $descImage = $request->file('description_image');
    $descImageName = Str::random(40) . '.' . $descImage->getClientOriginalExtension();
    $descImage->move(public_path('bhojwani/project_information/project_image'), $descImageName);
    $data['description_image'] = $descImageName;

    $moreImage = $request->file('more_image');
    $moreImageName = Str::random(40) . '.' . $moreImage->getClientOriginalExtension();
    $moreImage->move(public_path('bhojwani/project_information/project_image'), $moreImageName);
    $data['more_image'] = $moreImageName;

    // Other form data
    $data['banner_heading'] = $request->banner_heading;
    $data['banner_description'] = $request->banner_description;
    $data['description'] = $request->description;
    $data['heading'] = $request->heading;
    $data['more_description'] = $request->more_description;
    $data['created_by'] = Auth::id();

    BannerDetails::create($data);

    return redirect()->route('projectinformation-details.index')->with('message', 'Project Information successfully added!');
}


    public function edit($id)
    {
        $banner_details = BannerDetails::findOrFail($id);
        return view('backend.home-page.banner-details.edit', compact('banner_details'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'banner_heading' => 'required|string|max:255',
            'banner_image' => 'nullable|max:3072',  
        ], [
            'banner_heading.required' => 'The banner heading is required.',
            'banner_image.max' => 'The banner image must not be greater than 3MB.',
        ]);

        $banner = BannerDetails::findOrFail($id);  

        $imageName = $banner->banner_images;  
        if ($request->hasFile('banner_image')) {
            $image = $request->file('banner_image');
            $imageName = time() . rand(10, 999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('/bhojwani/home/banner'), $imageName);
        }

        $banner->banner_heading = $request->input('banner_heading');
        $banner->banner_images = $imageName;  
        $banner->modified_at = Carbon::now();
        $banner->modified_by = Auth::user()->id; 
        $banner->save();

        return redirect()->route('banner-details.index')->with('message', 'Banner has been successfully updated!');
    }

    public function destroy(string $id)
    {
        $data['deleted_by'] =  Auth::user()->id;
        $data['deleted_at'] =  Carbon::now();
        try {
            $industries = BannerDetails::findOrFail($id);
            $industries->update($data);

            return redirect()->route('banner-details.index')->with('message', 'Banner Details deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }

    

}