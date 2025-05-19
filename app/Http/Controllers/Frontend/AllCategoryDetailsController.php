<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\OurProjectDetail;
use App\Models\OurProjectCategory; // Import the model

class AllCategoryDetailsController extends Controller
{




public function footer(Request $request)

{
    return view('components.frontend.footer');
}

}
