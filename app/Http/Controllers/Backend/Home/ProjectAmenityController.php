<?php

namespace App\Http\Controllers\Backend\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProjectInformation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Exception;
use App\Models\ProjectAmenity;


class ProjectAmenityController extends Controller
{
    public function index()
    {
        return view('backend.our-project.project-amenity.index');
    }

    
public function create()
    {
        return view('backend.our-project.project-amenity.create');
    }

    public function store(Request $request)
    {
        
       
       
        $data['created_by'] = Auth::id();

        ProjectAmenity::create($data);

        return redirect()->route('projectamenity-details.index')->with('message', 'Project Information successfully added!');
    }

    public function edit($id)
    {
      

        return view('backend.our-project.project-amenity.edit', compact());
    }

    public function update(Request $request, $id)
    {
        

       
       
        $data['updated_by'] = Auth::id();

        $project->update($data);

        return redirect()->route('projectamenity-details.index')->with('message', 'Project Information updated successfully!');
    }

    public function destroy($id)
    {
        try {
            $project = ProjectAmenity::findOrFail($id);
            $project->update([
                'deleted_by' => Auth::id(),
                'deleted_at' => Carbon::now()
            ]);

            return redirect()->route('projectamenity-details.index')->with('message', 'Project Information deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something went wrong: ' . $ex->getMessage());
        }
    }
}
