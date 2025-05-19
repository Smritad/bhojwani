<?php

namespace App\Http\Controllers\Backend\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProjectWalkThrough;
use App\Models\OurProjectDetail;

use Illuminate\Support\Facades\Auth;

class WalkThroughController extends Controller
{
    private string $uploadDir = 'uploads/projectwalkthrough';

    /** List */
    public function index()
    {
        $walkthroughs = ProjectWalkThrough::all();
        return view('backend.our-project.projectwalkthrough.index', compact('walkthroughs'));
    }

    /** Create form */
    public function create()
    {        
        $projectid = OurProjectDetail::all();

        return view('backend.our-project.projectwalkthrough.create',compact('projectid'));
    }

    /** Store */
    public function store(Request $request)
{
    $request->validate([
        'project_id' => 'required|integer', // assuming numeric ID
        'background_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:512000',
        'video' => 'nullable|mimes:mp4,mov,avi,wmv|max:512000',
        'video_url' => 'nullable|url',
        'headings' => 'nullable|array',
        'headings.*' => 'nullable|string',
        'pdfs' => 'nullable|array',
        'pdfs.*' => 'nullable|mimes:pdf|max:20480',
    ]);

    $data = [];

    // Background image
    if ($request->hasFile('background_image')) {
        $data['background_image'] = $this->saveFile($request->file('background_image'), 'bg');
    }

    // Video or Video URL
    if ($request->hasFile('video')) {
        $data['video'] = $this->saveFile($request->file('video'), 'vid');
    } elseif ($request->filled('video_url')) {
        $data['video'] = $request->input('video_url');
    }

    // Headings & PDFs
    $headings = $request->input('headings', []);
    $data['headings'] = !empty($headings) ? implode(',', $headings) : null;

    $pdfNames = [];
    if ($request->hasFile('pdfs') && is_array($request->file('pdfs'))) {
        foreach ($request->file('pdfs') as $file) {
            $pdfNames[] = $this->saveFile($file, 'pdf');
        }
    }
    $data['pdfs'] = !empty($pdfNames) ? implode(',', $pdfNames) : null;

    // Project ID
    $data['project_id'] = $request->project_id;

    // Created by
    $data['created_by'] = Auth::id();

    ProjectWalkThrough::create($data);

    return redirect()->route('projectwalkthrough-details.index')
                     ->with('message', 'Walk Through added successfully!');
}


    /** Edit form */
    public function edit($id)
    {
        $walkthrough = ProjectWalkThrough::findOrFail($id);   // keep as strings
                  $projectid = OurProjectDetail::all();

        return view('backend.our-project.projectwalkthrough.edit', compact('walkthrough'),compact('projectid'));
    }

    /** Update */
    public function update(Request $request, $id)
    {
        $walkthrough = ProjectWalkThrough::findOrFail($id);
        $data = [];

        // Background image
        if ($request->hasFile('background_image')) {
            $data['background_image'] = $this->saveFile($request->file('background_image'), 'bg');
        }

        // Video (file or URL)
        if ($request->hasFile('video')) {
            $data['video'] = $this->saveFile($request->file('video'), 'vid');
        } elseif ($request->filled('video_url')) {
            $data['video'] = $request->input('video_url');
        }

        // Headings
        $headings = $request->input('headings', []);
        $data['headings'] = implode(',', $headings);

        // PDFs
        $oldPdfs = explode(',', $walkthrough->pdfs);
        $pdfNames = [];

        $pdfFiles = $request->file('pdfs') ?: [];

        foreach ($headings as $index => $heading) {
            if (isset($pdfFiles[$index]) && $pdfFiles[$index] !== null) {
                $pdfNames[] = $this->saveFile($pdfFiles[$index], 'pdf');
            } else {
                $pdfNames[] = $oldPdfs[$index] ?? '';
            }
        }

        $pdfNames = array_filter($pdfNames, fn($val) => !empty($val));

        $data['pdfs'] = implode(',', $pdfNames);

        // Set updated_by field
        $data['updated_by'] = Auth::id();

        $walkthrough->update($data);

        return redirect()->route('projectwalkthrough-details.index')
                         ->with('message', 'Walk Through updated successfully!');
    }

    /** Delete */
    public function destroy($id)
    {
        $walkthrough = ProjectWalkThrough::findOrFail($id);

        // Set deleted_by before soft deleting
        $walkthrough->deleted_by = Auth::id();
        $walkthrough->save();

        $walkthrough->delete(); // soft delete

        return redirect()->route('projectwalkthrough-details.index')
                         ->with('message', 'Walk Through deleted successfully!');
    }

    /** Helper */
    private function saveFile($file, string $prefix): string
    {
        $filename = time().'_'.$prefix.'_'.$file->getClientOriginalName();
        $file->move(public_path($this->uploadDir), $filename);
        return $filename;           // store only filename in DB
    }
}
