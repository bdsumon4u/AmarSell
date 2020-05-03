<?php

namespace App\Http\Controllers\Reseller;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest();
        $products_count = $products->count();
        $products = $products->paginate(12);
        return view('reseller.products.index', compact('products', 'products_count'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('reseller.products.product', compact('product'));
    }
}
