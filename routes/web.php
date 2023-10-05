<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', [RegisterController::class, 'create']);

Route::post('/register', [RegisterController::class, 'registerUser'])->name('register_user');

Route::get('/login', [LoginController::class, 'create']);

Route::post('/login', [LoginController::class, 'login'])->name('login_user');

Route::get('/home', [HomeController::class, 'create']);