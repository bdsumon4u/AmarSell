<?php

namespace App\Http\Controllers\Reseller;

use App\Category;
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
    public function index(Request $request, $slug = null, ?Category $category)
    {
        if($category->getKey()) {
            $products = $category->products();
        } else {
            $products = Product::latest();
        }
        $products = $request->has('s') ? $products->where('name', 'like', '%' . $request->s . '%') : $products;
        $products_count = $products->count();
        $products = $products->paginate(12)->appends($request->query());
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
