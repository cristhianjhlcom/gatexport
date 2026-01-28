<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

// use Intervention\Image\EncodedImage;

final class ImageUploadController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $manager = new ImageManager(new Driver());

        $file = $request->file('file');
        $filename = str()->uuid()->toString().'.'.$file->extension();
        $image = $manager->read($file->getPathname());
        $image->resize(1000, 1000, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });

        // Generar nombre único
        $path = storage_path("app/public/uploads/tmp/{$filename}");

        // Guardar como WebP
        $image->toWebp(80)->save($path); // 80 = calidad

        Log::info('Filed Uploaded', [
            'filename' => $filename,
        ]);

        return response()->json([
            'filename' => $filename,
            'original_name' => $file->getClientOriginalName(),
            'path' => $path,
            'width' => 1000,
            'height' => 1000,
            'size' => $file->getSize(),
            'mime_type' => $file->getMimeType(),
            'order' => $request->input('order', 0),
            'extension' => $file->extension(),
        ]);
    }
}
