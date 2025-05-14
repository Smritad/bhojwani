<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\OurProjectDetail;
use App\Models\OurProjectCategory; // Import the model

class CategoryDetailsController extends Controller
{

public function category_details()
{
    $bannerProject = OurProjectDetail::where('category_id', 4)->first();

    $category = OurProjectCategory::find(4); // Get category by ID

    $projects = OurProjectDetail::all(); // Or filter as needed for listings

    return view('frontend.project-listing', compact('bannerProject', 'category', 'projects'));
}


public function footer(Request $request)

{
    return view('components.frontend.footer', compact());
}

}
