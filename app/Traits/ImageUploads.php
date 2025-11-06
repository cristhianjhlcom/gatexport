<?php

declare(strict_types=1);

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

trait ImageUploads
{
    /**
     * Maneja la carga o reemplazo de archivos.
     *
     * @param array{
     *     newFile?: UploadedFile|null,
     *     currentPath?: string|null,
     *     directory: string,
     *     disk?: string
     * } $options
     * @return string|null
     */
    protected function upload($options): ?string
    {
        $currentPath = $options['currentPath'] ??= null;
        $newFile = $options['newFile'] ??= null;
        $disk = $options['disk'] ??= 'public';
        $directory = $options['directory'] ??= 'uploads';

        if (! $newFile) {
            Log::info("No new file to upload, keeping current path.", [
                'currentPath' => $currentPath,
            ]);

            return $currentPath;
        }

        if ($currentPath && Storage::disk($disk)->exists($currentPath)) {
            Log::info("Delete old file", [
                'path' => $currentPath,
                'disk' => $disk,
            ]);

            Storage::disk($disk)->delete($currentPath);
        }

        Log::info("Process to store new file", [
            'directory' => $directory,
            'disk' => $disk,
        ]);

        return $newFile->store($directory, $disk);
    }
}
