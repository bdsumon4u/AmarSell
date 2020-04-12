<?php

namespace App\Http\Controllers;

use App\Order;
use Darryldecode\Cart\Facades\CartFacade;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:reseller');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_id = auth('reseller')->user()->id;
        $data = $request->validate([
            'customer_name' => 'required|string',
            'customer_email' => 'nullable',
            'customer_phone' => 'required',
            'customer_address' => 'required|string',
            'shop' => 'required|string',
            'delevary_method' => 'required|string',
            'sell' => 'required|integer',
            'shipping' => 'required|integer',
            'advanced' => 'required|integer',
        ]);
        $cart = CartFacade::session($user_id);
        $data['price'] = $cart->getTotal();
        $products = $cart->getContent()
                        ->map(function ($item) {
                            $arr['id'] = $item->id;
                            $arr['quantity'] = $item->quantity;
                            $product = $item->attributes->product;
                            $arr['product'] = [
                                'sku' => $product->sku,
                                'wholesale_price' => $product->wholesale_price,
                                'retail_price' => $product->retail_price,
                            ];
                            return $arr;
                        });
        $data['products'] = $products->toArray();

        $order = Order::create([
            'reseller_id' => $user_id,
            'data' => $data,
        ]);

        return redirect()->route('shop.index')->with('success', 'Order Success. Order ID# ' . $order->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
