<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Storage;

class FileService
{
    const DISK = 'public';

    /**
     * @param UploadedFile $file
     * @param string $directoryPath
     * @return false|string
     */
    public function saveFile(UploadedFile $file, string $directoryPath)
    {
        return $file->store($directoryPath, ['disk' => self::DISK]);
    }

    /**
     * @param string $path
     * @return void
     */
    public function deleteFile(string $path): void
    {
        Storage::disk(self::DISK)->delete($path);
    }
}