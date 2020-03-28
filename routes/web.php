<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('getpass', 'Auth\LoginController@showLoginForm')->name('login');
Auth::routes(['register' => false]);
Route::get('/login', function(){
    return abort('404');
});

Route::get('/dashboard', 'HomeController@index')->name('home');

Route::group(['namespace' => 'Reseller', 'prefix' => 'reseller', 'as' => 'reseller.'], function(){
    Auth::routes(['verify' => true]);
    Route::get('/dashboard', 'HomeController@index')->name('home');
});

Route::view('/core', 'layouts.coreui');