<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use App\Helpers\Traits\ImageHelper;
use App\Image;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use ImageHelper;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = Category::formatted();
        $products = Product::when($request->s, function ($query) use ($request) {
            return $query->where('name', 'like', "%{$request->s}%");
        })->latest()->paginate(18);
        return view('admin.products.index', compact('categories', 'products'));
    }

    /**
     * Display a listing of the trashed resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trashed(Request $request)
    {
        $categories = Category::formatted();
        $products = Product::onlyTrashed()->when($request->s, function ($query) use ($request) {
            return $query->where('name', 'like', "%{$request->s}%");
        })->latest()->paginate(18);
        return view('admin.products.trashed', compact('categories', 'products'));
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
            'stock' => 'required_if:should_track,1',
            'description' => 'required',
            'meta_title' => 'nullable',
            'meta_keywords' => 'nullable|array',
            'meta_description' => 'nullable',
            'categories' => 'required|array',
            'categories.*' => 'required|integer',
            'wholesale' => 'required|integer',
            'retail' => 'required|integer',

            'base_image' => 'required|integer',
            'additional_images' => 'nullable|string',
        ], [
            'stock.required_if' => 'Stock count is required when inventory tracking is enabled.',
        ]);
        $data['code'] = $this->code();
        $product = Product::create($data);


        $images = [ $data['base_image'] => ['zone' => 'base'] ];
        if($data['additional_images']) {
            foreach(explode(',', $data['additional_images']) as $additional_image) {
                $images[$additional_image] = ['zone' => 'additionals'];
            }
        }
        $product->images()->sync($images);

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
        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::formatted();
        return view('admin.products.edit', compact('product', 'categories'));
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
        $data = $request->validate([
            'name' => 'required|max:255',
            'slug' => 'required|max:255',
            'should_track' => 'sometimes',
            'stock' => 'required_if:should_track,1',
            'description' => 'required',
            'meta_title' => 'nullable',
            'meta_keywords' => 'nullable|array',
            'meta_description' => 'nullable',
            'categories' => 'required|array',
            'categories.*' => 'required|integer',
            'wholesale' => 'required|integer',
            'retail' => 'required|integer',

            'base_image' => 'required|integer',
            'additional_images' => 'nullable|string',
        ], [
            'stock.required_if' => 'Stock count is required when inventory tracking is enabled.',
        ]);
        $data['stock'] = ($data['should_track'] ?? 0) == 1 ? $data['stock'] : NULL;
        $product->update($data);

        $images = [ $data['base_image'] => ['zone' => 'base'] ];
        if($data['additional_images']) {
            foreach(explode(',', $data['additional_images']) as $additional_image) {
                $images[$additional_image] = $images[$additional_image] ?? ['zone' => 'additionals'];
            }
        }
        $product->images()->sync($images);

        $product->categories()->sync($data['categories']);

        return redirect()->route('admin.products.index')->with('success', 'Product Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($product)
    {
        $product = Product::withTrashed()->findOrFail($product);

        if ($product->deleted_at) {
            $product->forceDelete();
        } else {
            $product->delete();
        }

        return back()->with('success', 'Product Deleted');
    }

    /**
     * Restore the specified resource to storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function restore($product)
    {
        Product::withTrashed()->findOrFail($product)->restore();

        return redirect()->route('admin.products.trashed')->with('success', 'Product Deleted');
    }
}
