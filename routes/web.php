<?php

use App\Order;
use App\Product;
use App\Reseller;
use App\Shop;
use App\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;

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
// dd(Order::find(2)->data);
Route::get('/', function () {
    return view('welcome');
});

Route::get('getpass', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('getpass', 'Auth\LoginController@login')->name('login');
Auth::routes(['register' => false]);
Route::match(['get', 'post'], '/login', function(){
    return abort('404');
});

Route::get('/dashboard', 'HomeController@index')->name('home');

Route::group(['namespace' => 'Reseller', 'prefix' => 'reseller', 'as' => 'reseller.'], function(){
    Auth::routes(['verify' => true]);
    Route::get('/dashboard', 'HomeController@index')->name('home');
});


Route::group(['middleware' => 'auth'], function(){
    Route::resource('categories', 'CategoryController');
    Route::resource('products', 'ProductController');
});

Route::group(['middleware' => 'auth:reseller'], function(){
    Route::get('shop', 'ShopController@index')->name('shop.index');
    Route::get('product/{product:slug}', 'ShopController@show')->name('shop.product.show');

    Route::get('/cart', 'CartController@index')->name('cart.index');
    Route::get('/cart/clear', 'CartController@clear')->name('cart.clear');
    Route::post('/cart/add/{product}', 'CartController@add')->name('cart.add');
    Route::delete('/cart/remove/{product}', 'CartController@remove')->name('cart.remove');
    Route::post('/cart/checkout', 'CartController@checkout')->name('cart.checkout');


    Route::post('/order/store', 'OrderController@store')->name('order.store');
});