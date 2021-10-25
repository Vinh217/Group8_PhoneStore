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

Route::middleware(['auth', 'isAdmin', 'prevent-back-history'])->group(function () {
    Route::get('/dashboard', "AdminController@dashboard");

    //Supplier-Admin
    Route::get('/supplier-list', "SupplierController@getAllSupplier");
    //Add Supplier
    Route::get('/add-supplier', 'SupplierController@add');
    Route::post('/insert-supplier', "SupplierController@insert");
    //EditSupplier
    Route::get('/edit-supplier/{id}', "SupplierController@edit");
    Route::put('/update-supplier/{id}', "SupplierController@update");
    // Disable-Active Supplier
    Route::put('/delete-supplier/{id}', "SupplierController@destroy");
    Route::put('/active-supplier/{id}', "SupplierController@active");

    //Product-Admin
    Route::get('/product-list', "ProductController@getAllProduct");
    //Insert Product
    Route::get('/add-product', "ProductController@add");
    Route::post('/insert-product', "ProductController@insert");
    //Update Product
    Route::get('/edit-product/{id}', "ProductController@edit");
    Route::put('/update-product/{id}', "ProductController@update");
    //Quantity
    Route::get('/product-quantity/{id}', "ProductController@productQuantity");
    Route::post('/insert-quantity/{id}', "ProductController@insertQuantity");
    Route::put('/update-quantity', "ProductController@updateQuantity");
    Route::put('/delete-quantity/{id}/{color}', "ProductController@deleteQuantity");
    //Disable-Active Product
    Route::put('/delete-product/{id}', "ProductController@destroy");
    Route::put('/active-product/{id}', "ProductController@active");
});

Route::get('/product-detail/{id}', "ProductController@getProductDetail");
Route::get('/product-instock/{id}/{color}', "ProductController@getNumberInstockByColor");
Route::get('/productBySupplier/{id}', "ProductController@productBySupplier");
