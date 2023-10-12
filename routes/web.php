<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;

use App\Http\Controllers\GetFavouritesController;
use App\Http\Controllers\RestaurantListController;

use Illuminate\Support\Facades\Auth;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//ROUTES FOR THE PAGES//

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', [RegisterController::class, 'create']);

Route::post('/register', [RegisterController::class, 'registerUser'])->name('register_user');

Route::get('/login', [LoginController::class, 'create']);

Route::post('/login', [LoginController::class, 'login'])->name('login_user');

Route::get('/home', function (){ return view('home'); });

Route::get('/about-us', function (){ return view("aboutus"); });

// Route::post('/restaurant-{name}', [])->name("load-restaurant");

Route::post('/restaurant', [])->name("load-restaurant");

Route::get('/logout', function () {
    //Session::flush();

    Auth::logout();
 
    $request->session()->invalidate();
 
    $request->session()->regenerateToken();

    return redirect('/login');
})->name("logout");

//ROUTES FOR GETTING DATA

Route::get("/get-favourited", [GetFavouritesController::class, 'getFavourited'])->name("get-favourites-each-user");

Route::post('/get-restaurants', [RestaurantListController::class, 'loadRestaurants'])->name("restaurant-list");