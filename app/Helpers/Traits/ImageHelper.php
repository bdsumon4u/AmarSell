<?php

namespace App\Helpers\Traits;

use Intervention\Image\Facades\Image;

trait ImageHelper
{
    protected function uploadImage($file, $arg = [])
    {
        // $filenameWithExt = $file->getClientOriginalName(); 
        // $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME); 
        // $extension = $file->getClientOriginalExtension(); 
        // $fileNameToStore= $filename.time().'.'.$extension; 
        // $thumbnailpic= 'thumb'.'-'.$fileNameToStore;

        // //This store image creates the folder and saves the file 
        // $path = $file->storeAs('public/' . ($arg['dir'] ?? 'images'), $fileNameToStore);

        // if(! is_dir($dir = public_path($arg['dir'] ?? 'images'))) {
        //     mkdir($dir, 755);
        // }
        // $to = ($arg['dir'] ?? 'images') . '/' . $thumbnailpic;

        // //Here is where I am trying to resize with image and it breaks
        // Image::make( storage_path().'/app/public/'. ($arg['dir'] ?? 'images') . '/'.$fileNameToStore)->resize($arg['width'] ?? 250, $arg['height'] ?? 66)->save(public_path($to));

        // return $to;

        $filename = time().$file->getClientOriginalName();
        $dirname = $arg['dir'] ?? 'images';

        $image = Image::make($file);
        if(! is_dir($dir = public_path($dirname))) {
            mkdir($dir, 755);
        }
        $image->resize($arg['width'] ?? 250, $arg['height'] ?? 66);
        $image->save($dir.'/'.$filename); 

        return $dirname.'/'.$filename;
    }
}
