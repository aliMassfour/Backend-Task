<?php

namespace App\MyService;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;


class StoreImage
{
    public function StoreImage(UploadedFile $image)
    {
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $imageName);
        return 'images' . '/' . $imageName;
    }
    public function delete(String $path){
        File::delete(public_path($path));
    }
}
