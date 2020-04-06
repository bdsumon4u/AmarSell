<?php

namespace App\Http\Controllers;

use App\User;
use App\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    /**
     * Shop Index
     */
    public function index(Request $request)
    {
        $products = Product::latest();
        $products_count = $products->count();
        $products = $products->paginate(12);
        return view('resellers.shop.index', compact('products', 'products_count'));
    }

    /**
     * Show
     */
    public function show(Request $request, Product $product)
    {
        return view('resellers.shop.product', compact('product'));
    }
}
