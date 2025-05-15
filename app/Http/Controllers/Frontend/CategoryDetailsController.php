<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\OurProjectDetail;
use App\Models\OurProjectCategory; 

class CategoryDetailsController extends Controller
{

    public function category_details()
    {
        $bannerProject = DB::table('our_project_details')
            ->where('category_id', 4)
            ->first();

        $category = DB::table('our_project_categories')->where('id', 4)->first();

        $projects = DB::table('our_project_details')
            ->join('our_project_categories', 'our_project_details.category_id', '=', 'our_project_categories.id')
            ->where('our_project_details.category_id', '!=', 4)
            ->select(
                'our_project_details.*',
                'our_project_categories.category_name',
                'our_project_categories.slug as category_slug'
            )
            ->get();
        // dd($projects);

        return view('frontend.project-listing', compact('bannerProject', 'category', 'projects'));
    }


    public function all_category_details($slug)
    {
        // Fetch the category by slug
        $category = OurProjectCategory::where('slug', $slug)->firstOrFail();

        // Fetch projects associated with this category
        $projects =  DB::table('our_project_details')
                        ->join('our_project_categories', 'our_project_details.category_id', '=', 'our_project_categories.id')
                        ->where('our_project_details.category_id', '!=', 4)
                        ->select(
                            'our_project_details.*',
                            'our_project_categories.category_name',
                            'our_project_categories.slug as category_slug'
                        )
                        ->get();


        return view('frontend.all-project-listing', compact('category', 'projects'));
    }





public function footer(Request $request)

{
    return view('components.frontend.footer', compact());
}

}
