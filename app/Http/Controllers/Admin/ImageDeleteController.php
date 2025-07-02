<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

final class ImageDeleteController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        // NOTE: Eliminar imagen segun la URL.
        $filename = $request->filename;
        $path = storage_path("app/public/uploads/tmp/{$filename}");

        if (file_exists($path)) {
            unlink($path);
        }

        Log::info('File Deleted', [
            'filename' => $filename,
        ]);

        return response()->json([
            'filename' => $filename,
        ]);
    }
}
