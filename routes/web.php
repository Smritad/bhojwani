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



use App\Http\Controllers\Frontend\HomeController;


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

// ==== Manage our project section 
Route::resource('ourproject-details', OurProjectDetailsController::class);
//================================================================================================== frontend
Route::group(['prefix'=> '', 'middleware'=>[\App\Http\Middleware\PreventBackHistoryMiddleware::class]],function(){

    // ==== Home
    Route::get('/', [HomeController::class, 'home'])->name('frontend.index');
});