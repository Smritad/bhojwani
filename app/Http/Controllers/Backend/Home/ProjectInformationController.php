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



class ProjectInformationController extends Controller
{

    public function index()
    {
       
        return view('backend.our-project.project-information.index');
    }

    public function create(Request $request)
    { 
        return view('backend.our-project.project-information.create');
    }


    public function store(Request $request)
    {
        
    
        
    
        return redirect()->route('projectinformation-details.index')->with('message', 'Banner has been successfully added!');
    }

    public function edit($id)
    {
        return view('backend.our-project.ourproject-details.edit', compact('banner_details'));
    }


    public function update(Request $request, $id)
    {
       
        return redirect()->route('projectinformation-details.index')->with('message', 'Banner has been successfully updated!');
    }

    public function destroy(string $id)
    {
        $data['deleted_by'] =  Auth::user()->id;
        $data['deleted_at'] =  Carbon::now();
        try {
            $industries = BannerDetails::findOrFail($id);
            $industries->update($data);

            return redirect()->route('projectinformation-details.index')->with('message', 'Banner Details deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }

    

}