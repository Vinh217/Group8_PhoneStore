<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShoppingCartController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\HomeController;
use App\Models\Customer;


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

Route::get('/main-page', [HomeController::class, 'index'])->name('main-page');

Auth::routes();

Route::middleware(['auth', 'isAdmin', 'prevent-back-history'])->group(function () {
    // Route::get('/dashboard', "AdminController@dashboard");
    Route::get('/dashboard', "OrderController@getAllOrder");

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
    //Customer-Admin
    Route::resource('customers', 'CustomerController');
    // To Update Customer
    Route::get('/customers/status/{customer_id}/{status_code}', [CustomerController::class, 'updateStatus'])->name('customers.status.update');
    //Admin-Order
    Route::get('/orderdetail/{id}', "OrderController@getOrderDetail");
    Route::put('/confirm-order/{id}', "OrderController@confirmOrder");
    Route::put('/cancel-order/{id}', "OrderController@cancelOrder");

    //Chart
    Route::get('/chart', 'ChartController@index');

    Route::get('/chart/revenue/{year}', 'ChartController@revenueByYear');
    Route::get('/chart/productBySupplier/{year}', 'ChartController@productSellBySupplier');

    //Slide Image
    Route::get('/banner-list', 'AdminController@getAllBanner');
    Route::get('/add-banner', 'AdminController@addBannerImage');
    Route::post('/insert-banner', 'AdminController@insertBannerImage');
    Route::delete('/delete-banner/{id}', 'AdminController@deleteBanner');
});

// Customer-Homepage
Route::prefix('user')->name('user.')->group(function () {
    Route::view('/login', 'Home.login')->name('login');
    Route::middleware(['guest:customer', 'prevent-back-history'])->group(function () {
        // Route::view('/login', 'Home.login')->name('login');
        // Route::view('/user-login', 'Home.login')->name('user-login');
        Route::view('/register', 'Home.register')->name('register');
        Route::post('/create', [CustomerController::class, 'register'])->name('create');
        Route::post('/check', [CustomerController::class, 'check'])->name('check');
        // Route::get('/fullcart', [ShoppingCartController::class, 'index'])->name('cart');
    });

    Route::middleware(['auth:customer', 'prevent-back-history'])->group(function () {
        Route::post('/signout', [CustomerController::class, 'logout'])->name('signout');
        Route::get('/fullcart', [ShoppingCartController::class, 'index'])->name('fullcart');
        Route::post('/add-feedback', 'ProductController@feedback');
    });
});


// Route::middleware(['auth:customer', 'prevent-back-history'])->group(function () {
//     // Route::get('/home', [HomeController::class, 'index'])->name('home');
//     Route::post('/signout', [CustomerController::class, 'logout'])->name('signout');
//     // Route::post('/user-logout', [CustomerController::class, 'logout'])->name('user-logout');
//     Route::get('/fullcart', [ShoppingCartController::class, 'index'])->name('fullcart');
//     Route::post('/add-feedback', 'HomeController@feedback');
// });

// social -login
Route::prefix('google')->name('google.')->group(function () {
    Route::get('login', [GoogleController::class, 'loginWithGoogle'])->name('login');
    Route::any('callback', [GoogleController::class, 'callbackFromGoogle'])->name('callback');
});

// Route::prefix('facebook')->name('facebook.')->group( function(){
//     Route::get('auth', [FaceBookController::class, 'loginUsingFacebook'])->name('login');
//     Route::get('callback', [FaceBookController::class, 'callbackFromFacebook'])->name('callback');
// });


Route::get('/product-detail/{id}', "ProductController@getProductDetail");
Route::get('/product-instock/{id}/{color}', "ProductController@getNumberInstockByColor");
Route::get('/productBySupplier/{id}', "ProductController@productBySupplier");

Route::get('/json/product-detail/{id}', 'ProductController@getProductDetailJSON');
