<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ConnectivityDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\OurProjectDetail;
use App\Models\OurProjectCategory; 
use App\Models\ProjectAmenity; 
use App\Models\OurProjectBanner; 

class CategoryDetailsController extends Controller
{

    

    public function our_project()
{
    // Get banners (from our_project_banners)
    $projectsbannner = OurProjectBanner::whereNull('deleted_at')->get();

    // Get project details with category names
    $projects = DB::table('our_project_details')
        ->join('our_project_categories', 'our_project_details.category_id', '=', 'our_project_categories.id')
        ->select(
            'our_project_details.*',
            'our_project_categories.category_name',
            'our_project_categories.slug as category_slug'
        )
        ->get();

    // Return both variables to the view
    return view('frontend.my-projects', compact('projects', 'projectsbannner'));
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

    // Step 3: Get all amenities
    $amenitiesRaw = DB::table('project_amenities')->where('project_id', $project->id)->first();

    $amenitiesData = [];

    if ($amenitiesRaw) {
        $description = $amenitiesRaw->description ?? '';
        $titles = explode(',', $amenitiesRaw->headings ?? '');
        $images = explode(',', $amenitiesRaw->thumbnail_images ?? '');

        $pairs = [];
        foreach ($titles as $index => $title) {
            $pairs[] = [
                'title' => trim($title),
                'image' => trim($images[$index] ?? ''),
            ];
        }

        $amenitiesData[] = [
            'description' => $description,
            'pairs' => $pairs,
        ];
    }

    $skyHigh = DB::table('projectskyhighluxuries')->where('project_id', $project->id)->first();
$svgPairs = [];

if ($skyHigh) {
    $svgTitles = explode(',', $skyHigh->titles ?? '');
    $svgImages = explode(',', $skyHigh->svg_images ?? '');

    foreach ($svgTitles as $index => $title) {
        $svgPairs[] = [
            'title' => trim($title),
            'image' => trim($svgImages[$index] ?? ''),
        ];
    }
}


    // Step 5: Get project walk-through details
$projectWalkThrough = DB::table('project_walk_throughs')->where('project_id', $project->id)->first();

$pdfData = [];
$backgroundImage = null;
$videoUrl = null;

if ($projectWalkThrough) {
    $backgroundImage = $projectWalkThrough->background_image ?? null;
    $videoUrl = $projectWalkThrough->video ?? null;

    $headings = explode(',', $projectWalkThrough->headings ?? '');
    $pdfs = explode(',', $projectWalkThrough->pdfs ?? '');

    $count = min(count($headings), count($pdfs));
    for ($i = 0; $i < $count; $i++) {
        $pdfData[] = [
            'heading' => trim($headings[$i]),
            'pdf' => trim($pdfs[$i]),
        ];
    }
}
$connectivity = DB::table('connectivity_details')
                      ->where('project_id', $project->id)
                      ->first();

    // If connectivity data is found, extract the necessary fields
    $connectivityData = [
        'section1_heading' => $connectivity->section1_heading,
        'section1_description' => $connectivity->section1_description,
        'section2_headings' => explode(',', $connectivity->section2_headings), // Assuming it's a comma-separated list
        'section2_svgs' => explode(',', $connectivity->section2_svgs),
        'section2_project_titles' => explode('|', $connectivity->section2_project_titles), // Assuming it's stored as pipe-separated values
    ];


    // Step 8: Get gallery images for this project
$galleryEntry = DB::table('gallery_images')->where('project_id', $project->id)->first();
$galleryImages = [];

if ($galleryEntry) {
    $filenames = explode(',', $galleryEntry->images ?? '');
    foreach ($filenames as $filename) {
        $galleryImages[] = asset('uploads/gallery/' . trim($filename));
    }
}

$mapData = DB::table('map_addresses')->where('project_id', $project->id)->first();

    // Final: Pass all data to the view
    return view('frontend.all-project-listing', [
    'project' => $project,
    'project_info' => $project_info,
    'amenitiesData' => $amenitiesData,
    'skyHigh' => $skyHigh,
    'svgPairs' => $svgPairs,
    'pdfData' => $pdfData,
    'backgroundImage' => $backgroundImage,
    'videoUrl' => $videoUrl,
        'connectivityData' => $connectivityData,
        'galleryEntry' => $galleryEntry,
    'galleryImages' => $galleryImages,
    'mapData' => $mapData,

]);

}










public function footer(Request $request)

{
    return view('components.frontend.footer');
}

}
