<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ShoppingCartController;
use App\Http\Controllers\CustomerController;


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

// Route::get('/home-login', "LoginController@index");
// Route::get('/home-register', [RegisterController::class, 'index']);

Route::get('/fullcart', [ShoppingCartController::class, 'index']);
Route::get('/single-product', "SingleProductController@index");

Auth::routes(['register' => false]);

Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/dashboard', "AdminController@dashboard");

    //Supplier-Admin
    Route::get('/supplier-list', "SupplierController@getAllSupplier");
    Route::get('/add-supplier', 'SupplierController@add');
    Route::post('/insert-supplier', "SupplierController@insert");
    Route::get('/edit-supplier/{id}', "SupplierController@edit");
    Route::put('/update-supplier/{id}', "SupplierController@update");
    Route::get('/delete-supplier/{id}', "SupplierController@destroy");
});

Route::prefix('user')->name('user.')->group(function(){

Route::middleware(['guest:web']) -> group(function() {
    Route::view('/login','Home.login')->name('login');
    Route::view('/register','Home.register')->name('register');
    Route::post('/create',[CustomerController::class,'create'])->name('create');
});

Route::middleware(['auth:web'])->group( function(){
    Route::view('/home','home')->name('layout.home_layout');
    Route::post('/logout',[CustomerController::class,'logout'])->name('logout');
});

});
