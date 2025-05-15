<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\BannerDetails;
use App\Models\DescriptionDetails;
use App\Models\IntroductionDetails;
use App\Models\GrowthSustainabilityDetail;
use App\Models\TestimonialsDetails;
use App\Models\OurProjectDetail;
use App\Models\OurProjectCategory;

class HomeController extends Controller
{

    public function home(Request $request)
    {
        $banners = BannerDetails::whereNull('deleted_at')->get();
        $description = DescriptionDetails::whereNull('deleted_at')->first();
        $intoduction = IntroductionDetails::whereNull('deleted_at')->first();
        $GrowthSustainability = GrowthSustainabilityDetail::whereNull('deleted_at')->first();
        $testimonials = TestimonialsDetails::whereNull('deleted_at')->get();

        // JOIN project details with category to get category_slug
        $projectdetails = DB::table('our_project_details as opd')
            ->join('our_project_categories as opc', 'opd.category_id', '=', 'opc.id')
            ->whereNull('opd.deleted_at')
            ->whereNull('opc.deleted_at')
            ->select(
                'opd.*',
                'opc.slug as category_slug'
            )
            ->get();
            // dd($projectdetails);

        return view('frontend.home', compact(
            'banners', 'description', 'intoduction',
            'GrowthSustainability', 'testimonials', 'projectdetails'
        ));
    }

public function footer(Request $request)

{
    return view('components.frontend.footer', compact());
}

}
