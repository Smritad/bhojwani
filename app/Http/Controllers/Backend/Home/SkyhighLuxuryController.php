<?php
namespace App\Http\Controllers\Backend\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Projectskyhighluxury;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use App\Models\OurProjectDetail;

class SkyhighLuxuryController extends Controller
{
    public function index()
    {
        $luxuries = Projectskyhighluxury::all();
        return view('backend.our-project.skyhighluxury.index', compact('luxuries'));
    }

    public function create()
    {
                        $projectid = OurProjectDetail::all();


        return view('backend.our-project.skyhighluxury.create',compact('projectid'));
    }

    public function store(Request $request)
{
    $request->validate([
        'project_id' => 'required|string',
        'heading' => 'required',
        'description' => 'required',
        'sections.*.svg' => 'required|file|mimes:svg',
        'sections.*.title' => 'required|string',
    ]);

    $svgFiles = [];
    $titles = [];

    if ($request->has('sections')) {
        foreach ($request->sections as $section) {
            if (isset($section['svg'])) {
                $file = $section['svg'];
                $filename = time() . '_' . Str::random(10) . '.svg';
                $file->move(public_path('uploads/skyhighluxury'), $filename);
                $svgFiles[] = $filename;
            }

            $titles[] = $section['title'];
        }
    }

    Projectskyhighluxury::create([
        'project_id' => $request->project_id,
        'heading' => $request->heading,
        'description' => $request->description,
        'svg_images' => implode(',', $svgFiles),
        'titles' => implode(',', $titles),
    ]);

    return redirect()->route('skyhighluxury-details.index')->with('message', 'Amenity added successfully!');
}


    public function edit($id)
    {
        $luxury = Projectskyhighluxury::findOrFail($id);
        $projectid = OurProjectDetail::all();
        return view('backend.our-project.skyhighluxury.edit', compact('luxury','projectid'));
    }

    public function update(Request $request, $id)
    {
        $luxury = Projectskyhighluxury::findOrFail($id);

        $request->validate([
            'heading' => 'required',
            'description' => 'required',
        ]);

        $svgFiles = explode(',', $luxury->svg_images ?? '');
        $titles = explode(',', $luxury->titles ?? '');

        // Clear existing if new uploaded
        if ($request->has('sections')) {
            $svgFiles = [];
            $titles = [];

            foreach ($request->sections as $section) {
                if (isset($section['svg'])) {
                    $file = $section['svg'];
                    $filename = time() . '_' . Str::random(10) . '.svg';
                    $file->move(public_path('uploads/skyhighluxury'), $filename);
                    $svgFiles[] = $filename;
                }
                $titles[] = $section['title'];
            }
        }

        $luxury->update([
            'heading' => $request->heading,
            'description' => $request->description,
            'svg_images' => implode(',', $svgFiles),
            'titles' => implode(',', $titles),
        ]);

        return redirect()->route('skyhighluxury-details.index')->with('message', 'Amenity updated successfully!');
    }

    public function destroy($id)
    {
        $luxury = Projectskyhighluxury::findOrFail($id);

        // Optionally remove image files
        $images = explode(',', $luxury->svg_images);
        foreach ($images as $img) {
            $file = public_path('uploads/skyhighluxury/' . $img);
            if (File::exists($file)) {
                File::delete($file);
            }
        }

        $luxury->delete();

        return redirect()->route('skyhighluxury-details.index')->with('message', 'Amenity deleted successfully!');
    }
}
