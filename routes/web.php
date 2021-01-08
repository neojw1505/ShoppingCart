<?php

use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Product;

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

Route::get('/welcome', function () {
    return view('welcome');
});

/* SEARCH */
Route::get('/search', 'SearchController@search')->name('search');

Route::get('/', 'CartController@shop')->name('shop');
Route::get('category/{category_id?}', 'CartController@shop')->name('shop');

Auth::routes();

/* CART */
Route::middleware('auth')->group(function () {
    Route::get('/cart', 'CartController@cart')->name('cart.index');
    Route::get('/cart-checkout', 'CartController@checkout')->name('cart.checkout');
    Route::post('/add', 'CartController@add')->name('cart.store');
    Route::post('/update', 'CartController@update')->name('cart.update');
    Route::post('/remove', 'CartController@remove')->name('cart.remove');
    Route::post('/clear', 'CartController@clear')->name('cart.clear');

    /* COUPON */
    Route::post('/coupon', 'CouponController@store')->name('coupon.store');
    Route::get('/coupon', 'CouponController@destroy')->name('coupon.destroy');
});

/* ADMIN */
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin-create-page', function () {
        return view('admin-create-page');
    })->name('admin.createpage');
    Route::post('admin-remove', 'AdminController@remove')->name('admin.remove');
    Route::post('admin-update', 'AdminController@update')->name('admin.update');
    Route::post('admin-create', 'AdminController@create')->name('admin.create');
});

/* ORDERS */
Route::middleware('auth')->group(function () {
    Route::get('user-orders', 'OrderController@index')->name('user-orders');
    Route::post('user-orders-cfm', 'OrderController@confirm')->name('user-orders-cfm');
    Route::get('user-orders-details', 'OrderController@showOrdersDetails')->name('user-orders-details');
    Route::get('user-orders-summary', 'OrderController@showOrderSummary')->name('user-orders-summary');

    /* DETAILS */
    Route::get('user-details', 'DetailsController@index')->name('user-details');
    Route::get('user-details-create', function () {
        return view('partials.user-details-create');
    });
    Route::get('user-details-edit', 'DetailsController@read')->name('user-details-edit');
    Route::post('user-details-create', 'DetailsController@create')->name('user-details-create');
    Route::post('user-details-update', 'DetailsController@update')->name('user-details-update');
});

Route::get('/test/{pro}', 'CartController@shop')->name('cart.test');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
