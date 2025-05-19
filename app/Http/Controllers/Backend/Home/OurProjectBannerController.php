<?php

namespace App\Http\Controllers\Backend\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OurProjectBanner;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;

class OurProjectBannerController extends Controller
{
    public function index()
    {
        $banner_details = OurProjectBanner::whereNull('deleted_at')->get();
        return view('backend.our-project.ourprojectbannerimg-details.index', compact('banner_details'));
    }

    public function create()
    {
        return view('backend.our-project.ourprojectbannerimg-details.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'banner_heading' => 'required|string|max:255',
            'banner_image' => 'required|image|max:5120',
        ]);

        $data = $request->only('banner_heading');

        if ($request->hasFile('banner_image')) {
            $file = $request->file('banner_image');
            $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/bhojwani/home/banner'), $filename);
            $data['banner_image'] = $filename;
        }

        $data['created_by'] = Auth::id();

        OurProjectBanner::create($data);

        return redirect()->route('ourprojectbannerimg-details.index')->with('message', 'Banner added successfully!');
    }

    public function edit($id)
    {
        $banner_details = OurProjectBanner::findOrFail($id);
        return view('backend.our-project.ourprojectbannerimg-details.edit', compact('banner_details'));
    }

    public function update(Request $request, $id)
    {
        $banner = OurProjectBanner::findOrFail($id);

        $request->validate([
            'banner_heading' => 'required|string|max:255',
            'banner_image' => 'nullable|image|max:5120',
        ]);

        $banner->banner_heading = $request->banner_heading;

        if ($request->hasFile('banner_image')) {
            $file = $request->file('banner_image');
            $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/bhojwani/home/banner'), $filename);
            $banner->banner_image = $filename;
        }

        $banner->updated_by = Auth::id();
        $banner->save();

        return redirect()->route('ourprojectbannerimg-details.index')->with('message', 'Banner has been successfully updated!');
    }

    public function destroy($id)
    {
        $banner = OurProjectBanner::findOrFail($id);
        $banner->deleted_by = Auth::id();
        $banner->deleted_at = Carbon::now();
        $banner->save();

        return redirect()->route('ourprojectbannerimg-details.index')->with('message', 'Banner Details deleted successfully!');
    }
}
