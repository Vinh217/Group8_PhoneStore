<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShoppingCartController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\GoogleController;
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

Route::get('/', function () {
    return view('Home.home');
});

Route::get('/fullcart', [ShoppingCartController::class, 'index']);
Route::get('/single-product', "SingleProductController@index");

Auth::routes();

Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/dashboard', "AdminController@dashboard");

    //Supplier-Admin
    Route::get('/supplier-list', "SupplierController@getAllSupplier");
    Route::get('/add-supplier', 'SupplierController@add');
    Route::post('/insert-supplier', "SupplierController@insert");
    Route::get('/edit-supplier/{id}', "SupplierController@edit");
    Route::put('/update-supplier/{id}', "SupplierController@update");
    Route::get('/delete-supplier/{id}', "SupplierController@destroy");

    //Customer-Admin
    Route::resource('customers', 'CustomerController');
    // To Update Customer
    Route::get('/customers/status/{customer_id}/{status_code}', [CustomerController::class, 'updateStatus'])->name('customers.status.update');

});

// Customer-Homepage

Route::prefix('user')->name('user.')->group(function(){

    Route::middleware(['guest:customer','PreventBackHistory']) -> group(function() {
        Route::view('/login','Home.login')->name('login');
        Route::view('/register','Home.register')->name('register');
        Route::post('/create',[CustomerController::class,'register'])->name('create');
        Route::post('/check',[CustomerController::class,'check'])->name('check');
    });
});

Route::middleware(['auth:customer','PreventBackHistory'])->group( function(){
    Route::view('/home','Home.home')->name('home');
    Route::post('/logout',[CustomerController::class,'logout'])->name('logout');
});


// social -login

Route::prefix('google')->name('google.')->group( function(){
    Route::get('login', [GoogleController::class, 'loginWithGoogle'])->name('login');
    Route::any('callback', [GoogleController::class, 'callbackFromGoogle'])->name('callback');
});

// Route::prefix('facebook')->name('facebook.')->group( function(){
//     Route::get('auth', [FaceBookController::class, 'loginUsingFacebook'])->name('login');
//     Route::get('callback', [FaceBookController::class, 'callbackFromFacebook'])->name('callback');
// });

