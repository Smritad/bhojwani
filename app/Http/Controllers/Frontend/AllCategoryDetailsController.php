<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\OurProjectDetail;
use App\Models\OurProjectCategory; // Import the model

class AllCategoryDetailsController extends Controller
{

public function all_category_details($slug)
{
    // Fetch the category by slug
    $category = OurProjectCategory::where('slug', $slug)->firstOrFail();

    // Fetch projects associated with this category
    $projects = OurProjectDetail::where('category_id', $category->id)->get();

    return view('frontend.all-project-listing', compact('category', 'projects'));
}



public function footer(Request $request)

{
    return view('components.frontend.footer', compact());
}

}
