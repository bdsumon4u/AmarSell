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
    public function index()
    {
        $categories = Category::formatted();
        $products = Product::paginate(20);
        return view('admin.products.index', compact('categories', 'products'));
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
            'categories' => 'required|array',
            'categories.*' => 'required|integer',
            'wholesale' => 'required|integer',
            'retail' => 'required|integer',

            'base_image' => 'required|image',
            'additional_images' => 'nullable|array',
            'additional_images.*' => 'nullable|image',
        ], [
            'stock.required_if' => 'Stock count is required when inventory tracking is enabled.',
            'additional_images.*.image' => 'All items of additional_images must be image.'
        ]);
        $data['code'] = $this->code();
        $product = Product::create($data);

        $file = $data['base_image'];
        $path = $this->uploadImage($file, ['dir' => 'images/products', 'height' => 600, 'width' => 600]);            
        $image = Image::create([
            'disk' => config('filesystems.default'),
            'filename' => $file->getClientOriginalName(),
            'path' => $path,
            'extension' => $file->guessClientExtension() ?? '',
            'mime' => $file->getClientMimeType(),
            'size' => $file->getSize(),
        ]);
        $product->images()->save($image, ['zone' => 'base']);
        foreach($data['additional_images'] as $file) {
            $path = $this->uploadImage($file, ['dir' => 'images/products', 'height' => 600, 'width' => 600]);
            $image = Image::create([
                'disk' => config('filesystems.default'),
                'filename' => $file->getClientOriginalName(),
                'path' => $path,
                'extension' => $file->guessClientExtension() ?? '',
                'mime' => $file->getClientMimeType(),
                'size' => $file->getSize(),
            ]);
            $product->images()->save($image, ['zone' => 'additionals']);
        }
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
            'stock' => 'required_if:should_track,1',
            'description' => 'required',
            'categories' => 'required|array',
            'categories.*' => 'required|integer',
            'wholesale' => 'required|integer',
            'retail' => 'required|integer',

            // 'base_image' => 'nullable|image',
            // 'additional_images' => 'nullable|array',
            // 'additional_images.*' => 'nullable|image',
        ], [
            'stock.required_if' => 'Stock count is required when inventory tracking is enabled.',
            'additional_images.*.image' => 'All items of additional_images must be image.'
        ]);

        if($request->hasFile('base_image')) {
            $file = $data['base_image'];
            $path = $this->uploadImage($file, ['dir' => 'images/products', 'height' => 600, 'width' => 600]);            
            $image = Image::create([
                'disk' => config('filesystems.default'),
                'filename' => $file->getClientOriginalName(),
                'path' => $path,
                'extension' => $file->guessClientExtension() ?? '',
                'mime' => $file->getClientMimeType(),
                'size' => $file->getSize(),
            ]);
            $product->images()->save($image, ['zone' => 'base']);
        }
        if($request->hasFile('additional_images')) {
            foreach($data['additional_images'] as $file) {
                $path = $this->uploadImage($file, ['dir' => 'images/products', 'height' => 600, 'width' => 600]);
                $image = Image::create([
                    'disk' => config('filesystems.default'),
                    'filename' => $file->getClientOriginalName(),
                    'path' => $path,
                    'extension' => $file->guessClientExtension() ?? '',
                    'mime' => $file->getClientMimeType(),
                    'size' => $file->getSize(),
                ]);
                $product->images()->save($image, ['zone' => 'additionals']);
            }
        }
        $product->categories()->sync($data['categories']);
        
        return redirect()->route('admin.products.index')->with('success', 'Product Updated');
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
