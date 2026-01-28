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
        $filename = basename($request->filename);

        // Validate filename contains only safe characters to prevent path traversal
        if (! preg_match('/^[a-zA-Z0-9_\-\.]+$/', $filename)) {
            abort(422, 'Invalid filename');
        }

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
