<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\OurProjectDetail;
use App\Models\OurProjectCategory; 

class CategoryDetailsController extends Controller
{

    

    public function our_project()
    {
        // $bannerProject = DB::table('our_project_details')
        //     ->where('category_id', 4)
        //     ->first();

        // $category = DB::table('our_project_categories')->where('id', 4)->first();

        $projects = DB::table('our_project_details')
            ->join('our_project_categories', 'our_project_details.category_id', '=', 'our_project_categories.id')
            // ->where('our_project_details.category_id', '=', 4)
            ->select(
                'our_project_details.*',
                'our_project_categories.category_name',
                'our_project_categories.slug as category_slug'
            )
            ->get();
        // dd($projects);

        return view('frontend.my-projects', compact('projects'));
    }


    public function category_details($slug)
    {
        // Fetch the category based on the slug
        $category = DB::table('our_project_categories')
            ->where('slug', $slug)
            ->first();

        // If no category found, abort with 404
        if (!$category) {
            abort(404, 'Category not found');
        }

        // Fetch the banner project for the category (assumed category_id 4 in original code, but dynamic now)
        $bannerProject = DB::table('our_project_details')
            ->where('category_id', $category->id)
            ->first();

        // Fetch projects that belong to this category
        $projects = DB::table('our_project_details')
            ->join('our_project_categories', 'our_project_details.category_id', '=', 'our_project_categories.id')
            ->where('our_project_details.category_id', $category->id) // Match category_id dynamically
            ->select(
                'our_project_details.*',
                'our_project_categories.category_name',
                'our_project_categories.slug as category_slug'
            )
            ->get();

        // Pass the fetched data to the view
        return view('frontend.project-listing', compact('bannerProject', 'category', 'projects'));
    }


   public function all_category_details($category_slug, $project_slug)
{
    // Step 1: Get the project details by joining with category
    $project = DB::table('our_project_details')
        ->join('our_project_categories', 'our_project_details.category_id', '=', 'our_project_categories.id')
        ->where('our_project_categories.slug', $category_slug)
        ->where('our_project_details.slug', $project_slug)
        ->select(
            'our_project_details.*',
            'our_project_categories.category_name',
            'our_project_categories.slug as category_slug'
        )
        ->first();

    if (!$project) {
        abort(404);
    }

    // Step 2: Get banner and gallery info from project_informations table
    $project_info = DB::table('project_informations')
        ->where('category_id', $project->id)
        ->first();

    return view('frontend.all-project-listing', compact('project', 'project_info'));
}








public function footer(Request $request)

{
    return view('components.frontend.footer', compact());
}

}
