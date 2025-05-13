<?php


namespace App\Http\Controllers\Backend\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\FooterDetails;

class FooterDetailsController extends Controller
{

public function index()
{
    $footerDetails = FooterDetails::whereNull('deleted_at')->get();
    return view('backend.home-page.footer-details.index', compact('footerDetails'));
}


    public function create()
    {
        return view('backend.home-page.footer-details.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'address' => 'required|string',
            'url' => 'required|url',
            'contact_number' => 'required',
            'about' => 'required|string',
            'social_media' => 'nullable|array',
        ]);

        FooterDetails::create([
            'email' => $request->email,
            'address' => $request->address,
            'url' => $request->url,
            'contact_number' => $request->contact_number,
            'about' => $request->about,
            'social_media' => $request->social_media,
        ]);

        return redirect()->route('footer.index')->with('message', 'Footer details added successfully!');
    }


public function edit(FooterDetails $footer)
{
    // Check if social_media is a JSON string or an already decoded array
    if (is_string($footer->social_media)) {
        $footer->social_media = json_decode($footer->social_media, true) ?? [];
    }

    // If social_media is already an array, no need to decode it
    return view('backend.home-page.footer-details.edit', compact('footer'));
}

public function update(Request $request, FooterDetails $footer)
{
    $request->validate([
        'email' => 'required|email',
        'address' => 'required|string',
        'url' => 'required|url',
        'contact_number' => 'required',
        'about' => 'required|string',
        'social_media' => 'nullable|array',
    ]);

    // Update the footer details
    $footer->update([
        'email' => $request->email,
        'address' => $request->address,
        'map_url' => $request->url,  // Ensure correct field name
        'contact_number' => $request->contact_number,
        'about' => $request->about,
        'social_media' => json_encode($request->social_media), // Save as JSON
    ]);

    // Redirect back to the index with a success message
    return redirect()->route('footer.index')->with('message', 'Footer details updated successfully!');
}


    public function destroy($id)
    {
        $footer = FooterDetails::findOrFail($id);
        $footer->update([
            'deleted_by' => Auth::id(),
            'deleted_at' => Carbon::now(),
        ]);

        return redirect()->route('footer.index')->with('message', 'Footer details deleted successfully!');
    }
}
