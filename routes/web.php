<?php

use App\Models\RestaurantRegion;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cache;

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AdminPageController;

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

Route::get('/basket', [CartController::class, 'start'])->name('basket-page');

Route::post('/checkout', [CartController::class, 'completeOrder'])->name('complete-order');

Route::match(['get', 'post'], '/send-reset-password', [AuthenticationController::class, 'sendRequest'])->name('send_password_reset');

Route::match(['get', 'post'], '/reset-password', [AuthenticationController::class, 'resetPassword'])->name('password_change');

//MIDDLEWARE FOR PROTECTION

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [RestaurantController::class, 'loadRestaurantsUnfiltered'])->name('home');

    Route::get('/admin', function (){ return view('admin'); })->middleware('admin.authentication')->name('admin_page');

    Route::post('/add-restaurant', [AdminPageController::class, 'addRestaurant'])->middleware('admin.authentication')->name('add_restaurant');

    Route::post('/remove-restaurant', [AdminPageController::class, 'removeRestaurant'])->middleware('admin.authentication')->name('remove_restaurant');

    Route::post('/remove-user', [AdminPageController::class, 'removeUser'])->middleware('admin.authentication')->name('remove_user');
});


Route::get('/about-us', function (){ return view('aboutus'); });

Route::post('/restaurant', [RestaurantController::class, 'loadClickedRestaurant'])->name('load-restaurant');

//ROUTES FOR GETTING DATA

Route::get('/get-favourited', [RestaurantController::class, 'getFavourited'])->name('get-favourites-each-user');

Route::post('/get-restaurants', [RestaurantController::class, 'loadRestaurants'])->name('restaurant-list');

Route::get('/get-options', function (){ 
    $cachedRegions = Cache::remember('restaurant-options', 60, function () {
        return response()->json(RestaurantRegion::select('city')->get());
    }); 

    return $cachedRegions;
})->name('get-restaurant-options');

Route::post('/handle-review', [ReviewController::class, 'reviewOperations'])->name('submit-delete-review');


Route::post('/add-product', [CartController::class, 'addItem'])->name('add-item');

Route::post('/remove-product', [CartController::class, 'removeItem'])->name('remove-item');