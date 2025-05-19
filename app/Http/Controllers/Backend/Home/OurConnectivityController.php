<?php

namespace App\Http\Controllers\Backend\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OurProjectDetail;

use App\Models\ConnectivityDetail;
use Illuminate\Support\Facades\File;

class OurConnectivityController extends Controller
{
    public function index()
    {
        $connectivities = ConnectivityDetail::all();
        return view('backend.our-project.ourconnectivity.index', compact('connectivities'));
    }

    public function create()
    {
                $projectid = OurProjectDetail::all();

        return view('backend.our-project.ourconnectivity.create',compact('projectid'));
    }

    public function store(Request $request)
{
    $request->validate([
        'project_id' => 'required|string',
        'section1_heading' => 'required|string',
        'section1_description' => 'required|string',
        'section2' => 'required|array',
        'section2.*.heading' => 'required|string',
        'section2.*.projects' => 'required|array',
        'section2.*.projects.*.project_title' => 'required|string',
        'section2.*.projects.*.project_matter' => 'required|string',
        'section2.*.icon' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,webp',
    ]);

    $section2 = $request->input('section2', []);

    $iconPaths = [];
    $headings = [];
    $projectTitles = [];
    $projectMatters = [];

    foreach ($section2 as $index => $item) {
        $iconPath = '';
        $file = $request->file("section2.$index.icon");

        if ($file) {
            $filename = time() . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/connectivity'), $filename);
            $iconPath = $filename; // store only filename
        }

        $iconPaths[] = $iconPath;
        $headings[] = $item['heading'];

        foreach ($item['projects'] as $project) {
            $projectTitles[] = $project['project_title'];
            $projectMatters[] = $project['project_matter'];
        }
    }

    ConnectivityDetail::create([
        'project_id' => $request->project_id,
        'section1_heading' => $request->section1_heading,
        'section1_description' => $request->section1_description,
        'section2_icons' => implode(',', $iconPaths),
        'section2_headings' => implode(',', $headings),
        'section2_project_titles' => implode(',', $projectTitles),
        'section2_project_matters' => implode(',', $projectMatters),
    ]);

    return redirect()->route('ourconnectivity-details.index')->with('message', 'Connectivity details added successfully.');
}


   public function edit($id)
{
    $connectivityDetail = ConnectivityDetail::findOrFail($id);
          $projectid = OurProjectDetail::all();

    // Explode the CSV fields into arrays
    $icons = $connectivityDetail->section2_icons ? explode(',', $connectivityDetail->section2_icons) : [];
    $headings = $connectivityDetail->section2_headings ? explode(',', $connectivityDetail->section2_headings) : [];
    $projectTitles = $connectivityDetail->section2_project_titles ? explode(',', $connectivityDetail->section2_project_titles) : [];
    $projectMatters = $connectivityDetail->section2_project_matters ? explode(',', $connectivityDetail->section2_project_matters) : [];

    // Reconstruct section2 structure
    $section2 = [];

    $projIndex = 0; // tracker for projects arrays

    foreach ($icons as $index => $icon) {
        $section2[$index] = [
            'icon' => $icon,
            'heading' => $headings[$index] ?? '',
            'projects' => [],
        ];

        // Assume each section has 2 projects (you need to adjust based on how many projects per section)
        // Since your projects are flat CSV arrays, you need to group projects per section properly.
        // Here, I'm assuming 2 projects per section as example:
        for ($i = 0; $i < 2; $i++) {
            $section2[$index]['projects'][] = [
                'project_title' => $projectTitles[$projIndex] ?? '',
                'project_matter' => $projectMatters[$projIndex] ?? '',
            ];
            $projIndex++;
        }
    }

    return view('backend.our-project.ourconnectivity.edit', compact('connectivityDetail', 'section2'),compact('projectid'));
}



   public function update(Request $request, $id)
{
    $connectivityDetail = ConnectivityDetail::findOrFail($id);

    $request->validate([
        'section1_heading' => 'required|string|max:255',
        'section1_description' => 'required|string',
        'section2' => 'array',
        'section2.*.heading' => 'required|string',
        'section2.*.icon' => 'nullable|file|mimes:svg,webp,jpg,jpeg,png',
        'section2.*.existing_icon' => 'nullable|string',
        'section2.*.projects' => 'array',
        'section2.*.projects.*.project_title' => 'required|string',
        'section2.*.projects.*.project_matter' => 'required|string',
    ]);

    $section2 = $request->input('section2', []);

    $icons = [];
    $headings = [];
    $projectsAll = []; // to hold projects grouped by section index

    // Handle uploaded files
    // Handle uploaded files
foreach ($section2 as $index => $section) {
    if ($request->hasFile("section2.$index.icon")) {
        $file = $request->file("section2.$index.icon");
        $filename = time() . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads/connectivity'), $filename);
        $icons[$index] = $filename; // ✅ Only filename
    } else {
        $icons[$index] = $section['existing_icon'] ?? '';
    }

    $headings[$index] = $section['heading'] ?? '';
    $projectsAll[$index] = $section['projects'] ?? [];
}



    

    // Convert projects into CSV strings (or however you want to store them)
    // For example, flatten project titles and matters separated by comma for all projects of all sections
    $projectTitles = [];
    $projectMatters = [];
    foreach ($projectsAll as $projects) {
        foreach ($projects as $proj) {
            $projectTitles[] = $proj['project_title'];
            $projectMatters[] = $proj['project_matter'];
        }
    }

    // Save Section 1 data
    $connectivityDetail->section1_heading = $request->input('section1_heading');
    $connectivityDetail->section1_description = $request->input('section1_description');

    // Save Section 2 data as CSV strings
    $connectivityDetail->section2_icons = implode(',', $icons);
    $connectivityDetail->section2_headings = implode(',', $headings);
    $connectivityDetail->section2_project_titles = implode(',', $projectTitles);
    $connectivityDetail->section2_project_matters = implode(',', $projectMatters);

    $connectivityDetail->save();

    return redirect()->route('ourconnectivity-details.index')->with('success', 'Project Connectivity Details updated successfully!');
}

    public function destroy($id)
    {
        $connectivity = ConnectivityDetail::findOrFail($id);
        $connectivity->delete();
        return redirect()->back()->with('message', 'Connectivity deleted.');
    }
}
