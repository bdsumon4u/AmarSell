<?php

namespace App\Http\Controllers\Reseller;

use App\Order;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Darryldecode\Cart\Facades\CartFacade;

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
    public function index(Request $request)
    {
        $filter = $request->filter ?? [];

        $orders = auth('reseller')->user()->orders()->where($filter)->latest()->get();

        return view('reseller.orders.list', compact('orders'));
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
            'shop' => 'required|integer',
            'delivery_method' => 'required|string',
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
                            $arr['code'] = $product->code;
                            $arr['slug'] = $product->slug;
                            $arr['wholesale'] = $product->wholesale;
                            $arr['retail'] = $product->retail;
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
        $products = Product::whereIn('id', array_keys($order->data['products']))->get();
        $cp = $order->current_price();
        return view('admin.orders.show', compact('order', 'products', 'cp'));
    }

    public function accept(Request $request, Order $order)
    {
        if($order->status != 'pending')
            return redirect()->back();
        
        $order->data += $request->validate([
            'buy_price' => 'required',
            'payable' => 'required',
            'profit' => 'required',
            'packaging' => 'required',
            'delivery_charge' => 'required',
            'cod_charge' => 'required',
        ]);
        $order->status = 'accepted';
        $order->save();

        return redirect('/dashboard')->with('success', 'Order Accepted');
    }

    public function invoice(Order $order)
    {
        return view('admin.orders.invoice', compact('order'));
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
