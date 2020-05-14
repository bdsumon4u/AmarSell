<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['namespace' => 'API', 'as' => 'api.'], function() {
    Route::get('images', 'ImageController@index')->name('images.index');
    Route::delete('images/destroy', 'ImageController@destroy')->name('images.destroy');

    Route::get('orders/{status?}/{reseller?}', 'OrderController@index')->name('orders.index');
    Route::get('transactions/{status?}/{reseller?}', 'TransactionController@index')->name('transactions.index');
});