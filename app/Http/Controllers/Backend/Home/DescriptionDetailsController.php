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
use App\Models\DescriptionDetails;
use App\Models\IntroductionDetails;


class DescriptionDetailsController extends Controller
{
    public function index()
    {
        // Fetch all home page description details
$descriptions = DescriptionDetails::whereNull('deleted_by')->get();
        return view('backend.home-page.description-details.index', compact('descriptions'));
    }

    public function create()
    {
        return view('backend.home-page.description-details.create');
    }

    public function store(Request $request)
    {
        // Validate the input data
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:20000',
        ]);

        // Store the description details
        DescriptionDetails::create([
            'title' => $request->title,
            'description' => $request->description,
            'created_by' => Auth::id(),
            'created_at' => Carbon::now(),
        ]);

        return redirect()->route('description-details.index')->with('message', 'Home Page Description added successfully!');
    }

    public function edit($id)
    {
        $description = DescriptionDetails::findOrFail($id);
        return view('backend.home-page.description-details.edit', compact('description'));
    }

    public function update(Request $request, $id)
    {
        // Validate the input data
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:20000',
        ]);

        // Update the description details
        $description = DescriptionDetails::findOrFail($id);
        $description->update([
            'title' => $request->title,
            'description' => $request->description,
            'modified_by' => Auth::id(),
            'modified_at' => Carbon::now(),
        ]);

        return redirect()->route('description-details.index')->with('message', 'Home Page Description updated successfully!');
    }

    public function destroy($id)
{
    $description = DescriptionDetails::findOrFail($id);

    $description->update([
        'deleted_by' => Auth::id(),
        'deleted_at' => Carbon::now(),
    ]);

    return redirect()->route('description-details.index')->with('message', 'Home Page Description deleted successfully!');
}

}
