<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::formatted();
        $products = Product::paginate(20);
        return view('admin.products.index', compact('categories', 'products'));
    }

    public function shop()
    {
        $products = Product::latest();
        $products_count = $products->count();
        $products = $products->paginate(12);
        return view('reseller.products.shop', compact('products', 'products_count'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::formatted();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:255',
            'slug' => 'required|max:255',
            'description' => 'required',
            'categories' => 'required|array',
            'categories.*' => 'required|integer',
            'wholesale' => 'required|integer',
            'retail' => 'required|integer',
        ]);
        $data['code'] = $this->code();

        $product = Product::create($data);

        $product->categories()->sync($data['categories']);

        return redirect()->route('admin.products.index')->with('success', 'Product Uploaded');
    }

    protected function code()
    {
        $code = Str::random(10);
        if(Product::where('code', $code)->first())
            $this->code();
        return $code;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('reseller.shop.product', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
