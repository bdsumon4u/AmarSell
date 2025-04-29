<?php

use App\Faq;
use App\Http\Middleware\PageMiddleware;
use App\Http\Middleware\RedirectToInstallerIfNotInstalled;
use App\Shop;
use App\User;
use App\Order;
use App\Product;
use App\Reseller;
use App\Services\EarningService;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Artisan;
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

Route::get('install/pre-installation', 'InstallController@preInstallation');
Route::get('install/configuration', 'InstallController@getConfiguration');
Route::post('install/configuration', 'InstallController@postConfiguration');
Route::get('install/complete', 'InstallController@complete');

Route::get('/dev', function () {
    // Artisan::call('config:cache');
    // Artisan::call('view:cache');
    Artisan::call('optimize:clear');
    // Artisan::call('storage:link');
    dd('DONE');
});

// dd(Order::find(2)->data);
Route::get('/', function (Request $request) {
    $faqs = cache('faqs', function () {
        $faqs = Faq::all();
        $faqs->each(function ($faq) {
            cache(["faq.{$faq->id}" => $faq]);
        });
        return $faqs;
    });
    return view('welcome')->withFaqs($faqs);
})->middleware([RedirectToInstallerIfNotInstalled::class, 'guest:reseller']);

Route::get('getpass', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('getpass', 'Auth\LoginController@login')->name('login');
Auth::routes(['register' => false]);
Route::match(['get', 'post'], '/login', function(){
    return abort('404');
});

Route::get('/dashboard', 'HomeController@index')->name('home');

Route::group(['prefix' => 'reseller', 'as' => 'reseller.'], function(){
    Route::group(['namespace' => 'Reseller'], function(){
        Auth::routes(['verify' => true]);
        Route::get('/dashboard', 'HomeController@index')->name('home');
    });

    Route::resource('shops', 'ShopController');
});


Route::group(['middleware' => 'auth', 'prefix' => 'admin', 'as' => 'admin.'], function(){
    Route::resource('categories', 'CategoryController');
    Route::get('/products/trashed', 'ProductController@trashed')->name('products.trashed');
    Route::resource('products', 'ProductController');
    Route::post('/products/{product}/restore', 'ProductController@restore')->name('products.restore');
    Route::resource('images', 'ImageController');
    Route::view('orders', 'admin.orders.list')->name('order.index');
    Route::get('order/print', 'OrderController@print')->name('order.print');
    Route::post('order/book-courier', 'OrderController@bookCourier')->name('order.book-courier');
    Route::post('order/booking', 'OrderController@booking')->name('order.booking');
    Route::get('order/{order}', 'OrderController@show')->name('order.show');
    Route::post('order/{order}/update', 'OrderController@update')->name('order.update');
    Route::get('order/{order}/invoice', 'OrderController@invoice')->name('order.invoice');
    Route::get('order/{order}/cancel', 'OrderController@cancel')->name('order.cancel'); #--#--#

    Route::get('/transactions/pay', 'TransactionController@pay')->name('transactions.pay');
    Route::get('/transactions/pay/{reseller}', 'TransactionController@payToReseller')->name('transactions.pay-to-reseller');
    Route::post('/transactions/pay/store', 'TransactionController@store')->name('transactions.pay.store');
    Route::view('/transactions/history', 'admin.transactions.index')->name('transactions.index');
    Route::view('/transactions/requests', 'admin.transactions.requests')->name('transactions.requests');
    Route::get('/transactions/{transaction}', 'TransactionController@show')->name('transactions.show');

    Route::resource('images', 'ImageController');
    Route::get('/notifications', 'NotificationController@index')->name('notifications.index');
    Route::patch('/notifications/read/{notification?}', 'NotificationController@update')->name('notifications.update');
    Route::delete('/notifications/destroy/{notification?}', 'NotificationController@destroy')->name('notifications.destroy');

    Route::resource('/resellers', 'ResellerController');

    Route::get('/pages', 'PageController@index')->name('pages.index');
    Route::get('/pages/create', 'PageController@create')->name('pages.create');
    Route::post('/pages/create', 'PageController@store')->name('pages.store');
    Route::get('/pages/{page:slug}/edit', 'PageController@edit')->name('pages.edit');
    Route::patch('/pages/{page:slug}/edit', 'PageController@update')->name('pages.update');
    Route::delete('/pages/{page:slug}/delete', 'PageController@destroy')->name('pages.destroy');

    Route::resource('hmenus', 'MenuController');
    Route::post('menuItems/{menu}/sort', 'MenuItemController@sort')->name('menuItems.sort');
    Route::resource('menuItems', 'MenuItemController');

    Route::get('/settings', 'SettingController@edit')->name('settings.edit');
    Route::patch('/settings', 'SettingController@update')->name('settings.update');

    Route::patch('/password', 'PasswordController')->name('password.update');

    Route::resource('/faqs', 'FaqController');


    Route::get('/admins', 'AdminController@index')->name('admins.index');
    Route::get('/admins/create', 'AdminController@create')->name('admins.create');
    Route::post('/admins/create', 'AdminController@store')->name('admins.store');
    Route::delete('/admins/{user}/destroy', 'AdminController@destroy')->name('admins.destroy');
});

Route::get('/page/{page:slug}', 'PageController@show')->name('page.show')->middleware(['auth:reseller', PageMiddleware::class]);
Route::post('/contact', 'ContactController')->name('contact');

Route::group(['middleware' => 'auth:reseller'], function(){
    Route::get('/cart', 'CartController@index')->name('cart.index');
    Route::get('/cart/clear', 'CartController@clear')->name('cart.clear');
    Route::post('/cart/add/{product}', 'CartController@add')->name('cart.add');
    Route::delete('/cart/remove/{product}', 'CartController@remove')->name('cart.remove');
    Route::get('/checkout', 'CartController@checkout')->name('cart.checkout');

});


Route::get('/earnings', 'EarningController')->name('earnings');


Route::group(['middleware' => 'auth:reseller', 'namespace' => 'Reseller', 'prefix' => 'reseller', 'as' => 'reseller.'], function() {
    Route::get('/products/category/{slug}/id/{category}', 'ProductController@index')->name('product.by-category');
    Route::get('/products', 'ProductController@index')->name('product.index')->middleware('iverified');
    Route::get('/product/{product:slug}', 'ProductController@show')->name('product.show');


    Route::view('/orders', 'reseller.orders.list')->name('order.index');
    Route::post('/order/store', 'OrderController@store')->name('order.store');
    Route::get('order/{order}', 'OrderController@show')->name('order.show');
    Route::get('order/{order}/invoice', 'OrderController@invoice')->name('order.invoice');
    Route::delete('order/{order}/delete', 'OrderController@destroy')->name('order.destroy');
    Route::get('order/{order}/cancel', 'OrderController@cancel')->name('order.cancel');


    Route::view('/transactions/history', 'reseller.transactions.index')->name('transactions.index');
    Route::get('/transactions/request', 'TransactionController@request')->name('transactions.request');
    Route::post('/transactions/request', 'TransactionController@store')->name('transactions.store');
    Route::get('/transactions/{transaction}', 'TransactionController@show')->name('transactions.show');

    Route::get('/setting', 'SettingController@edit')->name('setting.edit');
    Route::patch('/setting', 'SettingController@update')->name('setting.update');
    Route::view('/setting/profile', 'reseller.setting.profile');
    Route::patch('/setting/profile', 'SettingController@profile')->name('setting.profile');
    Route::view('/setting/payment', 'reseller.setting.payment');
    Route::patch('/setting/payment', 'SettingController@payment')->name('setting.payment');
    Route::view('/setting/password', 'reseller.setting.password');
    Route::patch('/password', 'PasswordController')->name('password.change');

    Route::get('/profile/{reseller}', 'ProfileController')->name('profile.show');
    Route::get('/notifications', 'NotificationController@index')->name('notifications.index');
    Route::patch('/notifications/read/{notification?}', 'NotificationController@update')->name('notifications.update');
    Route::delete('/notifications/destroy/{notification?}', 'NotificationController@destroy')->name('notifications.destroy');
});


Route::get('derning', function ()
{
    foreach(Reseller::whereNotNull('verified_at')->get() as $reseller) {
        dump($reseller->created_at->format('d-M-Y'));
        $service = new EarningService($reseller);
        dump($service->periods);
    }
});


Route::get('/clear', function () {
    Artisan::call('view:clear');
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
});
