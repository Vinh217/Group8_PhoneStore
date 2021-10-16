<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ShoppingCartController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/home', function () {
    return view('home');
});
Route::get('/', "HomeController@index");

Route::get('/home-login', "LoginController@index");
Route::get('/home-register', [RegisterController::class, 'index']);

Route::get('/fullcart', [ShoppingCartController::class, 'index']);
Route::get('/single-product', "SingleProductController@index");

Auth::routes(['register' => false]);

Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/dashboard', "AdminController@dashboard");
});
