<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

use App\Models\ProductDetails;
use Illuminate\Http\Request;

use App\Http\Controllers\Backend\UserDetailsController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\Home\BannerDetailsController;
use App\Http\Controllers\Backend\Home\DescriptionDetailsController;
use App\Http\Controllers\Backend\Home\IntroductionDetailsController;
use App\Http\Controllers\Backend\Home\SustainabilityDetailsController;
use App\Http\Controllers\Backend\Home\TestimonialsDetailsController;
use App\Http\Controllers\Backend\Home\FooterDetailsController;
use App\Http\Controllers\Backend\Home\OurProjectController;
use App\Http\Controllers\Backend\Home\OurProjectDetailsController;
use App\Http\Controllers\Backend\Home\ProjectInformationController;
use App\Http\Controllers\Backend\Home\ProjectAmenityController;
use App\Http\Controllers\Backend\Home\SkyhighLuxuryController;
use App\Http\Controllers\Backend\Home\WalkThroughController;
use App\Http\Controllers\Backend\Home\OurConnectivityController;
use App\Http\Controllers\Backend\Home\GalleryImageController;
use App\Http\Controllers\Backend\Home\OurProjectBannerController;
use App\Http\Controllers\Backend\Home\MapAddressController;



use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\CategoryDetailsController;
use App\Http\Controllers\Frontend\AllCategoryDetailsController;
use App\Http\Controllers\Frontend\ContactController;


Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', [LoginController::class, 'login'])->name('admin.login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('admin.authenticate');
Route::get('/logout', [LoginController::class, 'logout'])->name('admin.logout');
Route::get('/change-password', [LoginController::class, 'change_password'])->name('admin.changepassword');
Route::post('/update-password', [LoginController::class, 'updatePassword'])->name('admin.updatepassword');

Route::get('/register', [LoginController::class, 'register'])->name('admin.register');
Route::post('/register', [LoginController::class, 'authenticate_register'])->name('admin.register.authenticate');
    
// // Admin Routes with Middleware
Route::group(['middleware' => ['auth:web', \App\Http\Middleware\PreventBackHistoryMiddleware::class]], function () {
        Route::get('/dashboard', function () {
            return view('backend.dashboard'); 
        })->name('admin.dashboard');
});


// ==== Manage Banner Details in Home
Route::resource('banner-details', BannerDetailsController::class);

// ==== Manage Home page Description in Home
Route::resource('description-details', DescriptionDetailsController::class);

// ==== Manage Home page introduction in Home
Route::resource('information-details', IntroductionDetailsController::class);

// ==== Manage Home page Sustainability section in Home

Route::resource('growth-sustainability-details', SustainabilityDetailsController::class);

// ==== Manage Home page testimonial section in Home

Route::resource('testimonials-details', TestimonialsDetailsController::class);

// ==== Manage footer section in Home
Route::resource('footer', FooterDetailsController::class);

// ==== Manage our project section 
Route::resource('ourprojectcategory-details', OurProjectController::class);
// ==== Manage our project banner section 
Route::resource('ourprojectbannerimg-details', OurProjectBannerController::class);

// ==== Manage our project section 
Route::resource('ourproject-details', OurProjectDetailsController::class);

// ==== Manage our project section 
Route::resource('projectinformation-details', ProjectInformationController::class);

// ==== Manage our project section 
Route::resource('projectamenity-details', ProjectAmenityController::class);

// ==== Manage our projectwalkthrough-details  section 
Route::resource('projectwalkthrough-details', WalkThroughController::class);


// ==== Manage our Sky High Luxury section 
Route::resource('skyhighluxury-details', SkyhighLuxuryController::class);

// ==== Manage our Connectivity section 
Route::resource('ourconnectivity-details', OurConnectivityController::class);

// ==== Manage our Gallery iamge section 
Route::resource('galleryimage-details', GalleryImageController::class);

// ==== Manage our map section 
Route::resource('mapaddress-details',MapAddressController::class);



//================================================================================================== frontend
Route::group(['prefix'=> '', 'middleware'=>[\App\Http\Middleware\PreventBackHistoryMiddleware::class]],function(){

 
Route::get('/', [HomeController::class, 'home'])->name('frontend.index');
 Route::get('our-projects', [CategoryDetailsController::class, 'our_project'])->name('project');
 Route::get('{slug}', [CategoryDetailsController::class, 'category_details'])->name('our.project');
Route::get('/{category_slug}/{project_slug}', [CategoryDetailsController::class, 'all_category_details'])->name('project.details');



});