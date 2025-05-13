<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BannerDetails;
use App\Models\DescriptionDetails;
use App\Models\IntroductionDetails;
use App\Models\GrowthSustainabilityDetail;
use App\Models\TestimonialsDetails;

class HomeController extends Controller
{
public function home(Request $request)
{
    $banners = BannerDetails::whereNull('deleted_at')->get();
    $description = DescriptionDetails::whereNull('deleted_at')->first();
    $intoduction = IntroductionDetails::whereNull('deleted_at')->first();
    $GrowthSustainability = GrowthSustainabilityDetail::whereNull('deleted_at')->first();
    $testimonials = TestimonialsDetails::whereNull('deleted_at')->get(); // fetch all

    return view('frontend.home', compact(
        'banners', 'description', 'intoduction',
        'GrowthSustainability', 'testimonials'
    ));
}

public function footer(Request $request)

{
    return view('components.frontend.footer', compact());
}

}
