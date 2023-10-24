<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\ReviewController;

use App\Http\Middleware\AdminAuthenticate;

use Illuminate\Support\Facades\Auth;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the 'web' middleware group. Make something great!
|
*/

//ROUTES FOR THE PAGES//

Route::get('/register', [AuthenticationController::class, 'createRegister']);

Route::post('/register', [AuthenticationController::class, 'registerUser'])->name('register_user');


Route::get('/login', [AuthenticationController::class, 'createLogin']);

Route::post('/login', [AuthenticationController::class, 'login'])->name('login_user');


Route::get('/logout', [AuthenticationController::class, 'logout'])->name('logout');

//MIDDLEWARE FOR PROTECTION

Route::middleware(['auth'])->group(function () {
    Route::get('/home', function (){ return view('home'); })->name('home');

    Route::get('/admin', function (){ return view('admin'); })->middleware('admin.authentication')->name('admin_page');
});


Route::get('/about-us', function (){ return view('aboutus'); });

//MAKE PROTECTED HOME PAGE!!!

Route::post('/restaurant', [RestaurantController::class, 'loadClickedRestaurant'])->name('load-restaurant');

//ROUTES FOR GETTING DATA

Route::get('/get-favourited', [RestaurantController::class, 'getFavourited'])->name('get-favourites-each-user');

Route::post('/get-restaurants', [RestaurantController::class, 'loadRestaurants'])->name('restaurant-list');

Route::post('/send-review', [ReviewController::class, 'reviewOperations'])->name('submit-delete-review');