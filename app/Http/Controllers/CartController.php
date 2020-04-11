<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Darryldecode\Cart\Facades\CartFacade as Cart;

class CartController extends Controller
{
    /**
     * Cart Index
     */
    public function index()
    {
        return view('resellers.cart.index');
    }
    
    /**
     * Add Item
     */
    public function add(Request $request, Product $product)
    {
        $data = $request->has('qty') ? ['quantity' => $request->qty] : [];
        $data += [
            'quantity' => 1,
            'id' => $product->id,
            'name' => $product->title,
            'price' => $product->wholesale_price,
            'attributes' => [
                'product' => $product,
            ],
        ];

        $user_id = auth('reseller')->user()->id;
        Cart::session($user_id)->add($data);
        return redirect()->back()->with('success', 'Item Added To Cart.');
    }
    
    /**
     * Remove Item
     */
    public function remove(Product $product)
    {
        $user_id = auth('reseller')->user()->id;
        Cart::session($user_id)->remove($product->id);
        return redirect()->back()->with('success', 'Item Removed From Cart.');
    }

    /**
     * Clear Cart
     */
    public function clear()
    {
        $user_id = auth('reseller')->user()->id;
        Cart::session($user_id)->clear();
        return redirect()->back()->with('success', 'Cart Cleared.');
    }

    /**
     * Checkout
     */
    public function checkout(Request $request)
    {
        return view('resellers.checkout.index', [
            'sell' => $request->sell,
            'shipping' => $request->shipping,
            'advanced' => $request->advanced,
        ]);
    }
}
