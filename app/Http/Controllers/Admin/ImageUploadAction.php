<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Format;
use Intervention\Image\Laravel\Facades\Image;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Drivers\Gd\Encoders\WebpEncoder;
// use Intervention\Image\EncodedImage;

class ImageUploadAction extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $manager = new ImageManager(new Driver());

        $file = $request->file('file');
        $filename = str()->uuid()->toString() . '.' . $file->extension();
        $image = $manager->read($file->getPathname());
        $image->resize(1000, 1000, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });

        // Generar nombre único
        // $path = public_path('uploads/tmp/' . $filename);
        $path = storage_path("app/public/uploads/tmp/{$filename}");

        // Guardar como WebP
        $image->toWebp(80)->save($path); // 80 = calidad


        return response()->json([
            'image' => $filename,
            'size' => $file->getSize(),
            'type' => $file->getMimeType(),
            'extension' => $file->extension(),
        ]);
    }
}
