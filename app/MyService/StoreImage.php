<?php

namespace App\MyService;

use Illuminate\Http\UploadedFile;

class StoreImage
{
    public function StoreImage(UploadedFile $image)
    {
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $imageName);
        return 'images' . '/' . $imageName;
    }
}
