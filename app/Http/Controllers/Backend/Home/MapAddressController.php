<?php

namespace App\Http\Controllers\Backend\Home;

use App\Http\Controllers\Controller;
use App\Models\MapAddress;
use Illuminate\Http\Request;
use App\Models\OurProjectDetail;

class MapAddressController extends Controller
{
    public function index()
    {
        $mapAddresses = MapAddress::all();
        return view('backend.our-project.mapaddress.index', compact('mapAddresses'));
    }

    public function create()
    {        $projectid = OurProjectDetail::all();

        return view('backend.our-project.mapaddress.create',compact('projectid'));
    }

    public function store(Request $request)
    {
        $request->validate([
                        'project_id' => 'required|string',

            'heading' => 'required|string',
            'map_url' => 'required|string',
            'site_title' => 'required|string',
            'site_address' => 'required|string',
        ]);

        MapAddress::create([
                    'project_id' => $request->project_id,

            'heading' => $request->heading,
            'map_url' => $request->map_url,
            'site_title' => $request->site_title,
            'site_address' => $request->site_address,
            'created_by' => auth()->id(),
            'updated_by' => auth()->id(),
        ]);

        return redirect()->route('mapaddress-details.index')->with('message', 'Address added successfully!');
    }

    public function edit($id)
    {
        $mapAddress = MapAddress::findOrFail($id);
                $projectid = OurProjectDetail::all();

        return view('backend.our-project.mapaddress.edit', compact('mapAddress'),compact('projectid'));
    }

    public function update(Request $request, $id)
    {
        $mapAddress = MapAddress::findOrFail($id);

        $request->validate([
            'heading' => 'required|string',
            'map_url' => 'required|string',
            'site_title' => 'required|string',
            'site_address' => 'required|string',
        ]);

        $mapAddress->update([
            'heading' => $request->heading,
            'map_url' => $request->map_url,
            'site_title' => $request->site_title,
            'site_address' => $request->site_address,
            'updated_by' => auth()->id(),
        ]);

        return redirect()->route('mapaddress-details.index')->with('message', 'Address updated successfully!');
    }

    public function destroy($id)
    {
        $mapAddress = MapAddress::findOrFail($id);
        $mapAddress->update(['deleted_by' => auth()->id()]);
        $mapAddress->delete();

        return redirect()->route('mapaddress-details.index')->with('message', 'Address deleted successfully!');
    }
}
