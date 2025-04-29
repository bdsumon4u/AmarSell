<?php

use App\Order;
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

    Route::get('admin/orders/{status?}/{reseller?}', 'OrderController@admin')->name('orders.admin');
    Route::get('reseller/orders/{reseller?}/{status?}', 'OrderController@reseller')->name('orders.reseller');

    Route::get('transactions/{status?}/{reseller?}', 'TransactionController@index')->name('transactions.index');

    Route::get('resellers', 'ResellerController@index')->name('resellers.index');
    Route::get('resellers/edit', 'ResellerController@edit')->name('resellers.edit');
    Route::delete('resellers/delete', function (Request $request) {
        \App\Reseller::find($request->IDs)->map->delete();
    })->name('resellers.destroy');

    Route::get('pathao-webhook', function (Request $request): void {
        if ($request->header('X-PATHAO-Signature') != config('pathao.store_id')) {
            return;
        }

        if (! $order = Order::find($request->merchant_order_id)/*->orWhere('data->consignment_id', $request->consignment_id)->first()*/) {
            return;
        }

        // $courier = $request->only([
        //     'consignment_id',
        //     'order_status',
        //     'reason',
        //     'invoice_id',
        //     'payment_status',
        //     'collected_amount',
        // ]);
        // $order->forceFill(['courier' => ['booking' => 'Pathao'] + $courier]);

        if ($request->event == 'order.pickup-requested') {
            $order->fill([
                'status' => 'shipping',
                'data' => [
                    'consignment_id' => $request->consignment_id,
                ],
            ]);
        } elseif ($request->event == 'order.delivered') {
            $order->status = 'completed';
        } elseif ($request->event == 'order.returned') {
            $order->status = 'returned';
            // TODO: add to stock
        }

        $order->save();
    });


    Route::get('pathao-webhook', function (Request $request): void {
        if ($request->header('X-PATHAO-Signature') != config('pathao.store_id')) {
            return;
        }

        if (! $order = Order::find($request->merchant_order_id)/*->orWhere('data->consignment_id', $request->consignment_id)->first()*/) {
            return;
        }

        // $courier = $request->only([
        //     'consignment_id',
        //     'order_status',
        //     'reason',
        //     'invoice_id',
        //     'payment_status',
        //     'collected_amount',
        // ]);
        // $order->forceFill(['courier' => ['booking' => 'Pathao'] + $courier]);

        if ($request->event == 'order.pickup-requested') {
            $order->fill([
                'status' => 'shipping',
                'data' => [
                    'consignment_id' => $request->consignment_id,
                ],
            ]);
        } elseif ($request->event == 'order.delivered') {
            $order->status = 'completed';
        } elseif ($request->event == 'order.returned') {
            $order->status = 'returned';
            // TODO: add to stock
        }

        $order->save();
    });

    Route::get('steadfast-webhook', function (Request $request): void {
        if (! $order = Order::/*find($request->consignment_id)->*/where('data->consignment_id', $request->consignment_id)->first()) {
            return;
        }

        // $courier = $request->only([
        //     'consignment_id',
        //     'order_status',
        //     'reason',
        //     'invoice_id',
        //     'payment_status',
        //     'collected_amount',
        // ]);
        // $order->forceFill(['courier' => ['booking' => 'Pathao'] + $courier]);

        if ($request->status == 'Delivered') {
            $order->status = 'completed';
        }

        $order->save();
    });
});