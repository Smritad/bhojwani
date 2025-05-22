<?php

namespace App\Http\Controllers\Backend\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OurProjectDetail;
use App\Models\ConnectivityDetail;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

class OurConnectivityController extends Controller
{
    public function index()
    {
        // Soft deleted entries will be excluded by default
        $connectivities = ConnectivityDetail::all();
        return view('backend.our-project.ourconnectivity.index', compact('connectivities'));
    }

    public function create()
    {
        $projectid = OurProjectDetail::all();
        return view('backend.our-project.ourconnectivity.create', compact('projectid'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'project_id' => 'required|exists:our_project_details,id',
            'section1_heading' => 'required|string',
            'section1_description' => 'required|string',
            'section2_headings' => 'required|array',
            'section2_svgs' => 'required|array',
            'section2_project_titles' => 'required|array',
        ]);

        $filePaths = [];

        foreach ($request->section2_svgs as $file) {
            if ($file->isValid()) {
                $filename = time() . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/connectivity'), $filename);
                $filePaths[] = $filename;
            } else {
                return back()->with('error', 'One or more files are invalid.');
            }
        }

        $headings = implode(',', $request->section2_headings);
        $svgs = implode(',', $filePaths);
        $titles = collect($request->section2_project_titles)
                    ->map(fn($group) => implode(',', $group))
                    ->implode('|');

        ConnectivityDetail::create([
            'project_id' => $request->project_id,
            'section1_heading' => $request->section1_heading,
            'section1_description' => $request->section1_description,
            'section2_headings' => $headings,
            'section2_svgs' => $svgs,
            'section2_project_titles' => $titles,
            'created_by' => Auth::id(),
            'updated_by' => Auth::id(),
        ]);

        return redirect()->route('ourconnectivity-details.index')->with('message', 'Connectivity details added successfully.');
    }

    public function edit($id)
    {
        $connectivityDetail = ConnectivityDetail::findOrFail($id);
        $projectid = OurProjectDetail::all();

        $section2 = [
            'headings' => explode(',', $connectivityDetail->section2_headings),
            'svgs' => explode(',', $connectivityDetail->section2_svgs),
            'titles' => collect(explode('|', $connectivityDetail->section2_project_titles))
                        ->map(fn($group) => explode(',', $group)),
        ];

        return view('backend.our-project.ourconnectivity.edit', compact('connectivityDetail', 'projectid', 'section2'));
    }

    public function update(Request $request, $id)
    {
        $connectivityDetail = ConnectivityDetail::findOrFail($id);

        $request->validate([
            'project_id' => 'required|exists:our_project_details,id',
            'section1_heading' => 'required|string|max:255',
            'section1_description' => 'required|string',
            'section2_headings' => 'required|array',
            'section2_svgs' => 'nullable|array',
            'section2_existing_svgs' => 'nullable|array',
            'section2_project_titles' => 'required|array',
        ]);

        $icons = [];
        foreach ($request->section2_headings as $index => $heading) {
            if ($request->hasFile("section2_svgs.$index")) {
                $file = $request->file("section2_svgs.$index");
                $filename = time() . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/connectivity'), $filename);
                $icons[$index] = $filename;
            } else {
                $icons[$index] = $request->section2_existing_svgs[$index] ?? '';
            }
        }

        $headings = implode(',', $request->section2_headings);
        $svgs = implode(',', $icons);
        $titles = collect($request->section2_project_titles)
                    ->map(fn($group) => implode(',', $group))
                    ->implode('|');

        $connectivityDetail->update([
            'project_id' => $request->project_id,
            'section1_heading' => $request->section1_heading,
            'section1_description' => $request->section1_description,
            'section2_headings' => $headings,
            'section2_svgs' => $svgs,
            'section2_project_titles' => $titles,
            'updated_by' => Auth::id(),
        ]);

        return redirect()->route('ourconnectivity-details.index')->with('success', 'Project Connectivity Details updated successfully!');
    }

    public function destroy($id)
    {
        $connectivity = ConnectivityDetail::findOrFail($id);
        $connectivity->deleted_by = Auth::id();
        $connectivity->save();
        $connectivity->delete(); // Soft delete

        return redirect()->back()->with('message', 'Connectivity soft deleted.');
    }
}
