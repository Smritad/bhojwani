<?php


namespace App\Http\Controllers\Backend\Home;

use App\Http\Controllers\Controller;
use App\Models\IntroductionDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class IntroductionDetailsController extends Controller
{
    public function index()
    {
        $descriptions = IntroductionDetails::whereNull('deleted_by')->get();  // Fetch all description details
        return view('backend.home-page.introduction-details.index', compact('descriptions'));
    }

    public function create()
    {
        return view('backend.home-page.introduction-details.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        IntroductionDetails::create([
            'title' => $request->title,
            'description' => $request->description,
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('information-details.index')->with('message', 'Home Page Description added successfully!');
    }

    public function edit($id)
    {
        $description = IntroductionDetails::findOrFail($id);
        return view('backend.home-page.introduction-details.edit', compact('description'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $description = IntroductionDetails::findOrFail($id);
        $description->update([
            'title' => $request->title,
            'description' => $request->description,
            'updated_by' => Auth::id(),
        ]);

        return redirect()->route('information-details.index')->with('message', 'Home Page Description updated successfully!');
    }

    public function destroy($id)
    {
        $description = IntroductionDetails::findOrFail($id);
        $description->update([
            'deleted_by' => Auth::id(),
            'deleted_at' => Carbon::now(),
        ]);

        return redirect()->route('information-details.index')->with('message', 'Home Page Description deleted successfully!');
    }
}
