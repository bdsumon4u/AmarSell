<?php

namespace App\Http\Controllers;

use App\Image;
use Illuminate\Http\Request;
use App\Helpers\Traits\ImageHelper;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    use ImageHelper;
    
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
        // dd(Image::find(3)->path);
        $request->validate([
            'file' => 'required|image',
        ]);
        
        $file = $request->file('file');
        // $path = Storage::putFile('media', $file);
        $path = $this->uploadImage($file, ['dir' => 'images/products', 'height' => 150, 'width' => 150]);

        Image::create([
            'disk' => config('filesystems.default'),
            'filename' => $file->getClientOriginalName(),
            'path' => $path,
            'extension' => $file->guessClientExtension() ?? '',
            'mime' => $file->getClientMimeType(),
            'size' => $file->getSize(),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function show(Image $image)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function edit(Image $image)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Image $image)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function destroy(Image $image)
    {
        //
    }
}
