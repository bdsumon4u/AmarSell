<?php

namespace App\Http\Controllers;

use App\Events\OrderStatusChanged;
use App\Order;
use App\Product;
use Darryldecode\Cart\Facades\CartFacade;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filter = $request->filter ?? [];

        $orders = Order::where($filter)->latest()->get();

        return view('admin.orders.list', compact('orders'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        switch ($order->status) {
            case 'pending':
                $variant = 'secondary';
                break;
            case 'processing':
                $variant = 'warning';
                break;
            case 'shipping':
                $variant = 'primary';
                break;
            case 'completed':
                $variant = 'success';
                break;
            case 'returned':
                $variant = 'danger';
                break;

            default:
                # code...
                break;
        }
        $products = Product::whereIn('id', array_keys($order->data['products']))->get();
        $cp = $order->current_price();
        return view('admin.orders.show', compact('order', 'products', 'cp', 'variant'));
    }

    public function invoice(Order $order)
    {
        switch ($order->status) {
            case 'pending':
                $variant = 'secondary';
                break;
            case 'processing':
                $variant = 'warning';
                break;
            case 'shipping':
                $variant = 'primary';
                break;
            case 'completed':
                $variant = 'success';
                break;
            case 'returned':
                $variant = 'danger';
                break;

            default:
                # code...
                break;
        }
        return view('admin.orders.invoice', compact('order', 'variant'));
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
        // dump($order->data);
        if($order->status == 'completed' || $order->status == 'returned') {
            return back()->with('error', 'Order Can\'t be Updated');
        }

        tap($request->validate([
            'buy_price' => 'required',
            'payable' => 'required',
            'profit' => 'required',
            'packaging' => 'required',
            'delivery_charge' => 'required',
            'cod_charge' => 'required',
            'profit' => 'required',
            'delivery_method' => 'required',
            'booking_number' => 'nullable',
            'status' => 'required',
        ]), function($data) use($order, $request){
            $before = $order->status;
            $data['profit'] = $data['buy_price'] - ($data['packaging'] + $data['delivery_charge'] + $data['cod_charge']);
            $order->status = $data['status'];
            $data['completed_at'] = $data['status'] == 'completed' ? now()->toDateTimeString() : NULL;
            $data['returned_at'] = $data['status'] == 'returned' ? now()->toDateTimeString() : NULL;
            unset($data['status']);
            foreach($order->data as $key => $val) {
                $data[$key] = isset($data[$key]) ? $data[$key] : $val;
            }
            // dd($data);
            $order->data = $data;
            if($order->save()) {
                event(new OrderStatusChanged(['order' => $order, 'before' => $before]));
                foreach($order->data['products'] as $item) {
                    $product = Product::findOrFail($item['id']);
                    $product->stock = is_numeric($product->stock) ? $product->stock + $item['quantity'] : $product->stock;
                    $product->save();
                }
            }
        });

        return back()->with('success', 'Order Updated');
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

    public function cancel(Order $order)
    {
        if (in_array($order->status, ['completed', 'returned'])) {
            return redirect()->back()->with('error', "Order Can\'t be Cancelled.");
        }

        foreach($order->data['products'] as $item) {
            $product = Product::findOrFail($item['id']);
            $product->stock = is_numeric($product->stock) ? $product->stock + $item['quantity'] : $product->stock;
            $product->save();
        }
        $order->delete();
        return redirect()->back()->with('success', 'Order Cancelled');
    }
}
