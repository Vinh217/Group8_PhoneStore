<?php

use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ShoppingCartController;
use Illuminate\Support\Facades\Route;


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

Route::get('/', "HomeController@index");


Route::get('/admin-dashboard', "AdminController@dashboard");
Route::get('/admin-login', 'AdminController@adminlogin');

Route::get('/single-product', "SingleProductController@index");
Route::get('/home-login', "LoginController@index");

Route::get('/fullcart', [ShoppingCartController::class, 'index']);
Route::get('/home-register', [RegisterController::class, 'index']);

